/*
Title: esxi-control
Description: 
Author: Sébastien Lucas
Date: 2011/10/11
Robots: noindex,nofollow
Language: fr
*/
# esxi-control

Source : http://blog.peacon.co.uk/esxi-control-pl-script-vm-actions-on-free-licensed-esxi/

This is not my code / Ce n'est pas mon code

```perl
#!/usr/bin/perl -w

#
###############################################################################################################################

#
# esxi-control.pl

#
# Provides command-line control over virtual machines for ESX(i) 4, including free-licensed version.

#
###############################################################################################################################

#
# Usage:

#
# List registered VMs:

# esxi-control --server [hostname] --username [username] --password [password] --action list
#

# List Datastores:
# esxi-control --server [hostname] --username [username] --password [password] --action list-datastores

#
# List Recent Tasks:

# esxi-control --server [hostname] --username [username] --password [password] --action list-tasks
#

# Shutdown the ESXi Host:
# esxi-control --server [hostname] --username [username] --password [password] --action host-shutdown

#
# Restart the ESXi Host:

# esxi-control --server [hostname] --username [username] --password [password] --action host-reboot
#

# Get ESXi Host Power Management Policy:
# esxi-control --server [hostname] --username [username] --password [password] --action host-get-power-policy

#
# Change ESXi Host Power Management Policy:

# esxi-control --server [hostname] --username [username] --password [password] --action host-set-power-policy
#              --policy [high-performance|balanced|low-power|custom]

#
# VM actions:

# esxi-control --server [hostname] --username [username] --password [password]
#              --action [poweroff|poweron|reset|restart|shutdown|suspend|

#                        create-snapshot|revert-to-snapshot|delete-all-snapshots|remove-snapshot]
#              --snapshot [snapshot-name] [--remove-child-snapshots]

#              --vmname [vmname]
#

# File copy:
# esxi-control --server [hostname] --username [username] --password [password] --action copy-file --sourcefile [filename] --destfile [filename]

#
# File delete:

# esxi-control --server [hostname] --username [username] --password [password] --action delete-file --file [filename]
#

# Storage Functions:
#

# esxi-control --server [hostname] --username [username] --password [password] --action host-rescanvmfs
# esxi-control --server [hostname] --username [username] --password [password] --action host-rescanallhba

#
# where [action] is:

#   create-snapshot        to take a snapshot, named "auto-snapshot", unless
#                          --snapshotname [name] is specified

#   copy-file              to copy [sourcefile] to [destfile]
#   delete-all-snapshots   to remove all snapshots currently on a VM

#   delete-file            to delete [file] (use with caution!)
#   list                   to list the registered VMs

#   list-datastores        to list the datastores and their status
#   list-tasks             to list the status of any current actions

#   host-get-power-policy  to list the ESXi host power management policy currently in use
#   host-reboot            to reboot the ESXi host (use with caution!)

#   host-rescanallhba      to rescan all HBAs on the host
#   host-rescanvmfs        to rescan VMFS on the host

#   host-shutdown          to shutdown the ESXi host (use with caution!)
#   host-set-power-policy  to set the ESXi host power management policy (high-performance,balanced,low-power or custom)

#   poweroff               to power off a VM (forcefully)
#   poweron                to power on or resume, a VM

#   reset                  to forcefully reset a guest
#   restart                to request guest restart (needs vmware tools installed on the guest)

#   remove-snapshot        to remove the snapshot specified by name, and optionally child snaps on that
#                          (specify --remove-child-snapshots)

#   revert-to-snapshot     to revert to current snapshot,
#                          or a named snapshot if --snapshot [snapshot-name] is specified

#   shutdown               to shut down a VM gracefully (needs vmware tools installed on the guest)
#   suspend                to suspend the VM

#
#

# Examples of file paths:
#     [PERC5-1TB] ESX-Lab/vyatta-VC5/vyatta-VC5.vmdk

#     [SATA-1TB] Backups/vyatta.backup/vyatta-VC5.vmdk
#

# [vmname] is not needed for list- and host- options.
# [destfile] is not needed for the delete-file option.

#
##############################################################################################################################

#
# Version 1.29

#
# - New snapshot functionality added:

#   - create-snapshot    - --snapshotname [name] can now be added to specify the snapshot name
#   - remove-snapshot    - to remove the snapshot specified by name,

#                          or optionally child snaps on that (specify --remove-child-snapshots)
#   - revert-to-snapshot - to revert to the snapshot specified by name

#
# Note that vmware allows multiple snapshots to be created with the same name: therefore, use of this script

# REQUIRES diligence in snapshot naming (on the target VM) to be sure that the intended snapshot is reverted
# or deleted.

#
#

# Version 1.28
#

# - Fixed a bug in new task progress monitoring logic that prevented the routine exiting when a task returned an error
#   status until the task disapeared from the list

#
# Version 1.27

#
# - New task progress monitoring logic using $task_view->ViewBase::update_view_data();

#
#

# Version 1.26
#

# - No fixes since last version
# - Added host-rescanvmfs and host-rescanallhba functions

#
#

# Version 1.25
#

# - No fixes since last version
# - Consolidated coding in &controlVM()

# - Added reset and restart vm actions
#

#
# Version 1.24

#
# - No fixes since last version.

# - Added host-reboot command.
#

#
# Version 1.23

#
# Fixes since last version:

#
# - Changed error handling in monitorStatus function

#
#

# Version 1.22
#

# Fixes since last version:
#

# - removed a spurious line-feed when running tasks with status checking
#

#
# Version 1.21

#
# Fixes since last version:

#
# - corrected the hostname used by functions 

# - added host power management setting functions
# - fixed reporting of guest shutdown task

#
##############################################################################################################################

 
 
use strict;
use warnings;
use Term::ANSIColor;
use LWP::UserAgent;
use HTTP::Request;
use HTTP::Cookies;
use Data::Dumper;
use VMware::VIRuntime;
use VMware::VILib;
use XML::Parser;
 
 
# define command line parameters

 
my %opts = (
   'action' => {
      type => "=s",
      help => "The action requested:".
      				     "\n       - create-snapshot     to take a snapshot, named 'autosnapshot',".
      				     "\n                             unless --snapshot [snapshot-name] is specified".
      				     "\n       - delete-all-snaphots to remove ALL snapshots from the specied VM".
      				     "\n       - delete-file         ** DELETES A FILE WITHOUT CONFIRMATION **".
      				     "\n       - file-copy           to copy a file".
				     "\n       - list                to list the registered VMs".
      				     "\n       - list-datastores     to list datastores".
      				     "\n       - list-tasks          to list tasks".
				     "\n       - host-reboot         to reboot the ESXi host (use with caution!)".
				     "\n       - host-rescanvmfs     to rescan VMFS on the host".
				     "\n       - host-rescanallhba   to rescan all HBAs on the host".
				     "\n       - host-shutdown       to shutdown the ESXi host (use with caution!)".
      				     "\n       - poweroff            to power off a VM (forcefully)".
      				     "\n       - poweron             to power on or resume a VM".
      				     "\n       - reset               to forcefully reset a VM".
      				     "\n       - restart             to restart a VM via OS (needs vmware tools)".
      				     "\n       - remove-snaphot      to remove a snapshot from the specied VM,".
      				     "\n                             specified by --snapshot [snapshot-name]".
      				     "\n                             use --remove-child-snapshots to also remove".
      				     "\n                             any childs of that snapshot".
      				     "\n       - revert-to-snapshot  to revert to current snapshot, or a named".
      				     "\n                             snapshot specified by  --snapshot [snapshot-name]".
      				     "\n       - shutdown            to shut down a VM gracefully (needs vmware tools)".
      				     "\n       - suspend             to suspend a VM",
      required => 1,
   },
   'snapshotname' => {
      type => "=s",
      help => "For snapshot actions, the name of the snapshot",
      required => 0,
   },
   'remove-child-snapshots' => {
      type => "",
      help => "When removing snapshots, include this flag to also remove any children of that snapshot",
      required => 0,
      default => 0,
   },
   'vmname' => {
      type => "=s",
      help => "For VM actions, the name of the vm",
      required => 0,
   },
   'sourcefile' => {
      type => "=s",
      help => "For file copy action, the full path & name of the file to copy",
      required => 0,
   },
   'destfile' => {
      type => "=s",
      help => "For file copy action, the full path & name of the file to create",
      required => 0,
   },
   'file' => {
      type => "=s",
      help => "For file delete action, the full path & name of the file to delete",
      required => 0,
   },
   'policy' => {
      type => "=s",
      help => "For host-set-power-policy, the policy to apply",
      required => 0,
   },
   'logfile' => {
      type => "=s",
      help => "Name of logfile to use",
      required => 0,
      default => 'esxi-control.log',
   },
);
 
# read and validate command-line parameters 

Opts::add_options(%opts);
Opts::parse();
Opts::validate();
Util::connect();
 
# Global vars

my @hostlist;
my ($host_view,$request,$message,$response,$retval,$cookie);
my ($action,$snapshotname,$removeChildren,$vmname,$sourcefile,$destfile,$file,$policy,$logfile,$vmid);
my ($username,$password,$hostname);
 
# Get command-line data

$action         = Opts::get_option("action");
$vmname         = Opts::get_option("vmname");
$snapshotname   = Opts::get_option("snapshotname");
$removeChildren = Opts::get_option("remove-child-snapshots");
$sourcefile     = Opts::get_option("sourcefile");
$destfile       = Opts::get_option("destfile");
$file           = Opts::get_option("file");
$policy         = Opts::get_option("policy");
$logfile        = Opts::get_option("logfile");
$username       = Opts::get_option("username");
$password       = Opts::get_option("password");
$hostname       = Opts::get_option("server");
 
my $LOG_FILE = $logfile;
 
print "\nesxi-control - a perl script to control VMs for free-licensed ESXi\n\n";
 
# establish a view to the host...

$host_view = Vim::find_entity_view(view_type => 'HostSystem');
 
if ($action eq "list") {
	print "\nListing VMs...\n";
	&listVMs($host_view);
}
else {
	if ($action eq "list-datastores") {
		print "\nListing datastores...\n";
		&listDataStores($host_view);
	} elsif ($action eq "list-tasks") {
		print "\nListing running tasks...\n";
		&listTasks($host_view);
	} elsif ( ($action eq "copy-file") || ($action eq "delete-file") ) {
		&fileAction($host_view);
	} elsif ( ($action eq "poweroff") || ($action eq "poweron") || 
		  ($action eq "reset") || ($action eq "restart") ||
		  ($action eq "shutdown") || ($action eq "suspend") ||
		  ($action eq "create-snapshot") || ($action eq "delete-all-snapshots") ||
		  ($action eq "remove-snapshot") || ($action eq "revert-to-snapshot") ) {
		&controlVM($host_view);
	} elsif ($action eq "host-shutdown") {
		&hostShutdown($host_view);
	} elsif ($action eq "host-reboot") {
		&hostReboot($host_view);
	} elsif ($action eq "host-get-power-policy") {
		&hostGetPowerPolicy($host_view);
	} elsif ($action eq "host-set-power-policy") {
		&hostSetPowerPolicy($host_view);
	} elsif ( ($action eq "host-rescanallhba") || ($action eq "host-rescanvmfs") ) {
		&hostRescan($host_view);
	} elsif ($action eq "host-get-perf-counters") {
		&hostGetPerfData($host_view);
	} else {
		&writelog("  No actions were performed: invalid command.");
	}
}
 
 
Util::disconnect();
 
 
 
 
 
############################################################################

# MAIN SUB-ROUTINES; THESE DO THE WORK
############################################################################

 
 
 
 
sub listVMs {
# Prints a list of registered VM on the screen.

# Does not log it's use.
#

	my ($host_view) = @_;
	my $vms = Vim::get_views(mo_ref_array => $host_view->vm, properties => ['name','runtime.powerState','guest.toolsRunningStatus']);
	my $totalVMs = 0;
	foreach(@$vms) {
		$totalVMs += 1;
		print "VM: ".$_->{'name'}.", ".$_->{'runtime.powerState'}->val.", " 
		       .$_->{'guest.toolsRunningStatus'}.", ".$_->{'mo_ref'}->value."\n";
	}
	print "\nTotal ".$totalVMs." VMs found.\n\n"
}
 
 
 
sub listDataStores {
# Prints a list of datastores and their status

# Does not log it's use.
#

	my ($host_view) = @_;
 
	my $DSs = Vim::get_views(mo_ref_array => $host_view->datastore);
	my $totalDSs = 0;
	my $Accessible = "";
	my $capacity = 0;
	my $free = 0;
	foreach(@$DSs) {
		$totalDSs += 1;
		if($_->summary->accessible) { $Accessible = "Accessible"; }
		else { $Accessible = "Inaccessible"; }
		$capacity = (($_->summary->capacity)/1073741824);
		$free = (($_->summary->freeSpace)/1073741824);
		print $_->summary->name.", ".$Accessible.", ".$_->summary->type.
		", Size:".&commify(int($capacity))."GB, Free:".&commify(int($free))."GB\n";
	}
	print "\n".$totalDSs." datastores listed.\n\n"
}
 
 
 
sub listTasks {
# Prints a list of active tasks and their status

# Does not log it's use.
#

	my ($host_view) = @_;
 
	my $status = 'running';
	my $si_moref = ManagedObjectReference->new(type => 'ServiceInstance', value => 'ServiceInstance');
	my $si_view = Vim::get_view(mo_ref => $si_moref);
	my $sc_view;
	my $tm_view;
	$sc_view = $si_view->RetrieveServiceContent();
	$tm_view = Vim::get_view (mo_ref =>$sc_view->taskManager);
 
	my $totalTasks = 0;
	my $Task;
	if (defined $tm_view->recentTask) {
		foreach (@{$tm_view->recentTask}) {
			$totalTasks += 1;
			$Task = Vim::get_view(mo_ref => $_);
			print "\nKey: ".$Task->info->key."\n";
			print "     - Task  : ". $Task->info->descriptionId."\n";
			print "     - Status: ". $Task->info->state->val;
			if (defined $Task->info->progress) {
				print " (".$Task->info->progress."% complete)";
			}
			print "\n";
		}
	}
	print "\n".$totalTasks." tasks reported.\n\n"
}
 
 
 
sub hostShutdown {
# shuts down the ESXi host.  The host will use the VM startup and shutdown configuration per the vSphere

# client.
 
	my ($host_view) = @_;
 
	my ($message,$response,$retval,$cookie);
 
	&writelog("esxi-control called ".&giveMeDate('DMY')." at ".&giveMeDate('HMS'));
	&writelog("  Requested host shutdown on host $hostname");
 
	# we use $actions to check if the specified action was valid
	my $actions = 0;
	my $taskKey;
 
	$message = &createHelloMessage($username,$password);
	$response = &sendRequest($hostname,$message);
	$retval = checkReponse($response);					
 
	if($retval eq 1) {
		# grab cookie
		$cookie = &extractCookie($response);
 
		# action message 
		$message = createShutdownMessage();
		$response = &sendRequest($hostname,$message,$cookie);
		$retval = checkReponse($response);
 
		$taskKey = &getTaskKey($response->content);
 
		if($retval eq 1) {
			&writelog("  Request was accepted by $hostname.");
		} else {
			&writelog("  Did not get confirmation back from $hostname.");
		}
	} else {
		&writelog("  Requested host shutdown failed - could not connect to $hostname.");
	}
}
 
 
sub hostReboot {
# Reboots the ESXi host.  The host will use the VM startup and shutdown configuration per the vSphere

# client.
 
	my ($host_view) = @_;
 
	my ($message,$response,$retval,$cookie);
 
	&writelog("esxi-control called ".&giveMeDate('DMY')." at ".&giveMeDate('HMS'));
	&writelog("  Requested host reboot on host $hostname");
 
	# we use $actions to check if the specified action was valid
	my $actions = 0;
	my $taskKey;
 
	$message = &createHelloMessage($username,$password);
	$response = &sendRequest($hostname,$message);
	$retval = checkReponse($response);					
 
	if($retval eq 1) {
		# grab cookie
		$cookie = &extractCookie($response);
 
		# action message 
		$message = createRebootMessage();
		$response = &sendRequest($hostname,$message,$cookie);
		$retval = checkReponse($response);
 
		$taskKey = &getTaskKey($response->content);
 
		if($retval eq 1) {
			&writelog("  Request was accepted by $hostname.");
		} else {
			&writelog("  Did not get confirmation back from $hostname.");
		}
	} else {
		&writelog("  Requested host reboot failed - could not connect to $hostname.");
	}
}
 
 
sub hostGetPerfData {
# lists VM performance data

# doesn't log it as a read-only event
 
	my ($host_view) = @_;
	my $content = Vim::get_service_content();
 
	my $perfManager = Vim::get_view(mo_ref => $content->perfManager);
	my $counter = $perfManager->perfCounter;
 
        print "Performance Info: \n";
        foreach (@$counter) {
        	print $_->description."\n";
        }
}
 
 
 
sub hostGetPowerPolicy {
# lists the power management policy currently in use

# doesn't log it as a read-only event
 
	my ($host_view) = @_;
 
	my $hardwareSystem = Vim::get_view(mo_ref => $host_view->configManager->powerSystem);
        print "Current power management policy: ";
        print $hardwareSystem->info->currentPolicy->key;
        print " (".$hardwareSystem->info->currentPolicy->shortName.")\n";
}
 
 
 
sub hostSetPowerPolicy {
# sets the power management policy currently in use

 
	my ($host_view) = @_;
 
	&writelog("esxi-control called ".&giveMeDate('DMY')." at ".&giveMeDate('HMS'));
	&writelog("  Requested host power management policy change on host $hostname");
 
	# check specified policy was valid and map it to the code used in the SOAP call
	my $policyCode = 0;
	if ($policy eq "high-performance") { $policyCode = 1; }
	else { if ($policy eq "balanced") { $policyCode = 2; }
	else { if ($policy eq "low-power") { $policyCode = 3; }
	else { if ($policy eq "custom") { $policyCode = 4; } } } }
 
	if ($policyCode == 0) {
		&writelog("  Invalid power policy specified (".$policy.")");
	} else {
		my $hardwareSystem = Vim::get_view(mo_ref => $host_view->configManager->powerSystem);
	        $hardwareSystem->ConfigurePowerPolicy( key => $policyCode );
 
		# Doesn't return a result so re-query to check the action was completed
		$hardwareSystem = Vim::get_view(mo_ref => $host_view->configManager->powerSystem);
		if ($policyCode == $hardwareSystem->info->currentPolicy->key) { $retval = "1" }
		else { $retval = "0" }
 
		if($retval eq 1) {
			&writelog("  Policy on ".$hostname." set to ".$hardwareSystem->info->currentPolicy->shortName.".");
		} else {
			&writelog("  Policy on ".$hostname." could not be updated.");
		}
	}
}
 
 
 
sub fileAction {
# Performs file actions - copy and delete

 
	my ($host_view) = @_;
 
	my ($message,$response,$retval,$cookie);
 
	&writelog("esxi-control called ".&giveMeDate('DMY')." at ".&giveMeDate('HMS'));
	&writelog("  Requested file action $action on host $hostname");
 
	# we use $actions to check if the specified action was valid
	my $actions = 0;
	my $taskKey;
 
	# check the actions (copy/delete)
 
	if ($action eq "copy-file") {
		# user requested to copy a file
		# operation will succeed only if source exists and is not locked, and
		# if destination path exists
		&writelog("  Attempting to copy:");
		&writelog("    $sourcefile");
		&writelog("    to: $destfile.");
		# perform the task!
		$actions += 1;
		$message = &createHelloMessage($username,$password);
		$response = &sendRequest($hostname,$message);
		$retval = checkReponse($response);					
 
		if($retval eq 1) {
			# grab cookie
			$cookie = &extractCookie($response);
 
			# action message depending on whether VMDK or not
			if ($sourcefile =~ m/.vmdk/i) {
				# VMDK file
				$message = createVMDKCopyMessage();
			} else {
				$message = createFileCopyMessage();
			}
 
			$response = &sendRequest($hostname,$message,$cookie);
			$retval = checkReponse($response);
 
			$taskKey = &getTaskKey($response->content);
 
			if($retval eq 1) {
				&writelog("  Request was accepted by $hostname.");
				if (&monitorStatus($taskKey) == 1) {
					&writelog("  Task did not complete successfully.");
				} else {
					&writelog("  Task complete successfully.");
				}
			} else {
				&writelog("  Did not get confirmation back from $hostname");
			}
		}
	}
 
	if ($action eq "delete-file") {
		# user requested deleting a file - hope they meant it!
		&writelog("  Attempting to delete $file.");
		# perform the task!
		$actions += 1;
		$message = &createHelloMessage($username,$password);
		$response = &sendRequest($hostname,$message);
		$retval = checkReponse($response);					
 
		if($retval eq 1) {
			# grab cookie
			$cookie = &extractCookie($response);
 
			# action message depending on whether VMDK or not
			if ($file =~ m/.vmdk/i) {
				# VMDK file
				$message = createVMDKDeleteMessage();
			} else {
				$message = createFileDeleteMessage();
			}
 
			$response = &sendRequest($hostname,$message,$cookie);
			$retval = checkReponse($response);
 
			$taskKey = &getTaskKey($response->content);
 
			if($retval eq 1) {
				&writelog("  Request was accepted by $hostname.");
				if (&monitorStatus($taskKey) == 1) {
					&writelog("  Task did not complete successfully.");
				} else {
					&writelog("  Task complete successfully.");
				}
			} else {
				&writelog("  Did not get confirmation back from $hostname");
			}
		}
	}
 
	# now report on status
	if($actions==0) {
		&writelog("  No actions were performed: invalid command.");
	}
	else {
		if($retval ne 1) {
			&writelog("  Requested action failed.");
		}
	}
}
 
 
 
sub controlVM {
# Performs the specified control action on the named VM.  Logs this fact.

#
# Cycles through the registered VMs to try an match against the specified name

# to pull out the VMID.
#

	my ($host_view) = @_;
 
	my $vms = Vim::get_views(mo_ref_array => $host_view->vm, properties => ['name','runtime.powerState','guest.toolsRunningStatus','snapshot']);
 
	my ($message,$response,$retval,$cookie);
 
	&writelog("esxi-control called ".&giveMeDate('DMY')." at ".&giveMeDate('HMS'));
	&writelog("  Requested $action of $vmname on host $hostname");
 
	# we'll use vmid to check if we found the requested vm at the end
	$vmid = 0;
 
	# and actions to check if the specified action was valid
	my $actions = 0;
	my $taskKey;
 
	# now try to do the action (power/snapshot etc)
	foreach(@$vms) {
		if ($_->{'name'} eq $vmname) {
			# found the VM, now check action is valid
			if (	($action eq "poweroff") || ($action eq "poweron") || 
		  		($action eq "reset") || ($action eq "restart") ||
		  		($action eq "shutdown") || ($action eq "suspend") ||
		  		($action eq "create-snapshot") || ($action eq "delete-all-snapshots") ||
		  		($action eq "remove-snapshot") ||($action eq "revert-to-snapshot") ) {
 
				$vmid = $_->{'mo_ref'}->value;
				&writelog("  Attempting $action on VM $vmname, VMID $vmid");
 
				# check vm state is compatible with requested action
				$retval = 1;
				if ($action eq "poweron") {
					# user requested poweron, check the VM is not already on
					if ($_->{'runtime.powerState'}->val eq "poweredOn") {
						&writelog("  Error: VM $vmname is already powered on.");
						$retval = 0;
					}
				} elsif ($_->{'runtime.powerState'}->val ne "poweredOn") {
					# user requested an action that needs the VM powered on
					&writelog("  Error: VM $vmname must be powered on to request $action");
					$retval = 0;
				}
 
				# check vmware tools are running for tasks requiring them
				if ( ($retval eq 1) && ( ($action eq "restart") || ($action eq "shutdown") ) ) {
		  			if ($_->{'guest.toolsRunningStatus'} ne "guestToolsRunning") {
						&writelog("  Error: VM $vmname does not have vmware tools running.");
						$retval = 0;
					}
				}
 
				if ($retval eq 1) {
					# VM is in a compatible state - perform the task
					$actions += 1;
					$message = &createHelloMessage($username,$password);
					$response = &sendRequest($hostname,$message);
					$retval = checkReponse($response);					
 
					if($retval eq 1) {
						# grab cookie
						$cookie = &extractCookie($response);
						$message = "";
 
						# action message - based on requested action
						if ($action eq "poweroff") {
							$message = createVMPowerOffMessage();
						} elsif ($action eq "poweron") {
							$message = createVMPowerOnMessage();
						} elsif ($action eq "reset") {
							$message = createVMResetMessage();
						} elsif ($action eq "restart") {
							$message = createVMRestartMessage();
						} elsif ($action eq "shutdown") {
							$message = createVMShutdownMessage();
						} elsif ($action eq "suspend") {
							$message = createVMSuspendMessage();
						} elsif ($action eq "create-snapshot") {
							# check if snapshot name was given
							if ($snapshotname) {
								$message = createVMSnapShotMessage($snapshotname);
							} else {
								$message = createVMSnapShotMessage("auto-snapshot");
							}
						} elsif ($action eq "delete-all-snapshots") {
							$message = createVMDeleteAllSnapShotMessage();
						} elsif ($action eq "remove-snapshot") {
							# check that snapshot name was given
							if ($snapshotname) {
								# find the snapshot internal ID
								# first check there are snapshots on the VM
								if ($_->{'snapshot'}) {
									my $snapshotid = findSnapShotID($_->{'snapshot'},$snapshotname );
									if ($snapshotid) {
										&writelog("  Found snapshot $snapshotname - will use ".($vmid."-snapshot-".$snapshotid));
										if ($removeChildren) { &writelog("  Will remove child snapshots too"); }
										$message = createVMSnapShotRemoveMessage(($vmid."-snapshot-".$snapshotid),$removeChildren);
									} else {
										&writelog("  Couldn't find a snapshot named $snapshotname");
									}
								} else {
									&writelog("  VM has no snapshots.");
								}
							} else {
								# no snapshot name given - cannot continue
								&writelog("  Snapshot name not given - nothing to do");
							}
						} elsif ($action eq "revert-to-snapshot") {
							# check if a snapshot name was given
							if ($snapshotname) {
								# find the snapshot internal ID
								# first check there are snapshots on the VM
								if ($_->{'snapshot'}) {
									my $snapshotid = findSnapShotID($_->{'snapshot'},$snapshotname );
									if ($snapshotid) {
										&writelog("  Found snapshot $snapshotname - will use ".($vmid."-snapshot-".$snapshotid));
										$message = createVMSnapShotRevertMessage(($vmid."-snapshot-".$snapshotid));
									} else {
										&writelog("  Couldn't find a snapshot named $snapshotname");
									}
								} else {
									&writelog("  VM has no snapshots.");
								}
							} else {
								# no snapshot name given - revert to current
								&writelog("  Snapshot name not given - reverting to current");
								$message = createVMSnapShotRevertToCurrentMessage();
							}
						}
 
						if ($message) {
							$response = &sendRequest($hostname,$message,$cookie);
							$retval = checkReponse($response);
 
							$taskKey = &getTaskKey($response->content);
 
							if($retval eq 1) {
								&writelog("  Request was accepted by $hostname.");
								unless (($action eq "restart") || ($action eq "shutdown")) {
									if (&monitorStatus($taskKey) == 1) {
										&writelog("  Task did not complete successfully.");
									} else {
										&writelog("  Task complete successfully.");
									}
								}
							} else {
								&writelog("  Did not get confirmation back from $hostname");
							}
						} else {
							&writelog("  Command encountered an error.");
						}
					}
				}
				}
		}
	}
 
	# now report on status
	if($vmid==0) {
		&writelog("  No actions were performed: VM not found.");
	} elsif ($actions==0) {
		&writelog("  No actions were performed: Invalid action requested.");
	} elsif ($retval ne 1) {
		&writelog("  Requested action failed.");
	}
}
 
 
 
sub hostRescan {
	my ($host_view) = @_;
 
	my ($message,$response,$retval,$cookie, $taskKey);
 
	&writelog("esxi-control called ".&giveMeDate('DMY')." at ".&giveMeDate('HMS'));
	&writelog("  Requested $action on host $hostname");
 
	$message = &createHelloMessage($username,$password);
	$response = &sendRequest($hostname,$message);
	$retval = checkReponse($response);					
 
	if($retval eq 1) {
		# grab cookie
		$cookie = &extractCookie($response);
 
		# action message - based on requested action
		if ($action eq "host-rescanvmfs") {
			$message = createRescanVmfsMessage();
		} elsif ($action eq "host-rescanallhba") {
			$message = createRescanAllHbaMessage();
		}
 
		$response = &sendRequest($hostname,$message,$cookie);
		$retval = checkReponse($response);
 
		$taskKey = &getTaskKey($response->content);
 
	}
 
	if($retval eq 1) {
		&writelog("  Request was accepted by $hostname.");
	} else {
		&writelog("  Did not get confirmation back from $hostname");
	}
}
 
 
 
#############################################################

#
# Snapshot tree trawler follows

#
#############################################################

 
sub findSnapShotID {
	my ($vmsnapshot, $searchstr) = @_;
	my $id = 0;
	my $found = 0;
 
	foreach (@{$vmsnapshot->rootSnapshotList}) {
		$id = checkSnaps($_, $searchstr);
		if ($id) {
			$found = $id;
		}
	}
	return $found;
}
 
sub checkSnaps {
	my ($snapshotTree, $searchstr) = @_;
	my $found = 0;
 
 	if ($snapshotTree->name eq $searchstr) {
 		# found what we're looking for; return the id
 		$found = $snapshotTree->id;
 	} else {
		# keep looking - recurse through the tree of snaps
		if ($snapshotTree->childSnapshotList) {
			# loop through any children that may exist
			foreach (@{$snapshotTree->childSnapshotList}) {
				$found = checkSnaps($_, $searchstr);
				if ($found) {
					return $found;
				}
			}
		}
	}							
	return $found;
}
 
 
 
#############################################################

#
# Functions to provide the required SOAP requests

#
#############################################################

 
 
sub sendRequest {
	my ($host,$msg,$cookie) = @_;
	my $host_to_connect = "https://" . $host . "/sdk";
 
	my $userAgent = LWP::UserAgent->new(agent => 'VMware VI Client/4.1.0');
	my $request = HTTP::Request->new(POST => $host_to_connect);
	$request->header(SOAPAction => '"urn:internalvim25/4.1"');
	$request->content($msg);
	$request->content_type("text/xml; charset=utf-8");
 
	if(defined($cookie)) {
		$cookie->add_cookie_header($request);
	}	
	my $rsp = $userAgent->request($request);
}
 
 
sub createHelloMessage {
	my ($user,$pass) = @_;
 
	my $msg = <<SOAP_HELLO_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Login xmlns="urn:internalvim25">
      <_this xsi:type="SessionManager" type="SessionManager"
serverGuid="">ha-sessionmgr</_this>
      <userName>$user</userName>
      <password>$pass</password>
      <locale>en_US</locale>
    </Login>
  </soap:Body>
</soap:Envelope>
SOAP_HELLO_MESSAGE
 
	return $msg;
}
 
 
 
sub createShutdownMessage {
	my $msg = <<SOAP_SHUTDOWN_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ShutdownHost_Task xmlns="urn:internalvim25">
      <_this xsi:type="HostSystem" type="HostSystem" serverGuid="">ha-host</_this>
      <force>true</force>
    </ShutdownHost_Task>
  </soap:Body>
</soap:Envelope>
SOAP_SHUTDOWN_MESSAGE
 
	return $msg;
}
 
 
 
sub createRebootMessage {
	my $msg = <<SOAP_SHUTDOWN_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RebootHost_Task xmlns="urn:internalvim25">
      <_this xsi:type="HostSystem" type="HostSystem" serverGuid="">ha-host</_this>
      <force>true</force>
    </RebootHost_Task>
  </soap:Body>
</soap:Envelope>
SOAP_SHUTDOWN_MESSAGE
 
	return $msg;
}
 
 
 
sub createVMDKDeleteMessage {
	my $msg = <<SOAP_VMFILEDELETEMESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Delete_Task xmlns="urn:internalvim25">
      <_this xsi:type="FileManager" type="FileManager" serverGuid="">ha-nfc-file-manager</_this>
      <datacenter type="Datacenter" serverGuid="">ha-datacenter</datacenter>
      <datastorePath>$file</datastorePath>
      <fileType>VirtualDisk</fileType>
    </Delete_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMFILEDELETEMESSAGE
 
	return $msg;
 
}
 
 
sub createFileDeleteMessage {
	my $msg = <<SOAP_VMFILEDELETEMESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Delete_Task xmlns="urn:internalvim25">
      <_this xsi:type="FileManager" type="FileManager" serverGuid="">ha-nfc-file-manager</_this>
      <datacenter type="Datacenter" serverGuid="">ha-datacenter</datacenter>
      <datastorePath>$file</datastorePath>
      <fileType>File</fileType>
    </Delete_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMFILEDELETEMESSAGE
 
	return $msg;
 
}
 
 
sub createFileCopyMessage {
	my $msg = <<SOAP_VMFILECOPYMESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Copy_Task xmlns="urn:internalvim25">
      <_this xsi:type="FileManager" type="FileManager" serverGuid="">ha-nfc-file-manager</_this>
      <sourceDatacenter type="Datacenter" serverGuid="">ha-datacenter</sourceDatacenter>
      <sourcePath>$sourcefile</sourcePath>
      <destinationPath>$destfile</destinationPath>
      <force>false</force>
      <fileType>File</fileType>
    </Copy_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMFILECOPYMESSAGE
 
	return $msg;
}
 
 
 
sub createVMDKCopyMessage {
	my $msg = <<SOAP_VMFILECOPYMESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Copy_Task xmlns="urn:internalvim25">
      <_this xsi:type="FileManager" type="FileManager" serverGuid="">ha-nfc-file-manager</_this>
      <sourceDatacenter type="Datacenter" serverGuid="">ha-datacenter</sourceDatacenter>
      <sourcePath>$sourcefile</sourcePath>
      <destinationPath>$destfile</destinationPath>
      <force>false</force>
      <fileType>VirtualDisk</fileType>
    </Copy_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMFILECOPYMESSAGE
 
	return $msg;
}
 
 
 
sub createVMDeleteAllSnapShotMessage {
	my $msg = <<SOAP_VMDELETEALLSNAPSHOT_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RemoveAllSnapshots_Task xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
    </RemoveAllSnapshots_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMDELETEALLSNAPSHOT_MESSAGE
 
	return $msg;
}
 
 
 
sub createVMSnapShotMessage {
	my ($name) = @_;
 
	my $msg = <<SOAP_VMSNAPSHOT_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <CreateSnapshot_Task xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
      <name>$name</name>
      <description></description>
      <memory>false</memory>
      <quiesce>true</quiesce>
    </CreateSnapshot_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMSNAPSHOT_MESSAGE
 
	return $msg;
}
 
 
sub createVMSnapShotRevertMessage {
	my ($vmsnapshotid) = @_;
	my $msg = <<SOAP_VMSNAPSHOTREVERT_MESSAGE;
 
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RevertToSnapshot_Task xmlns="urn:internalvim25">
      <_this xsi:type="ManagedObjectReference" type="VirtualMachineSnapshot" serverGuid="">$vmsnapshotid</_this>
    </RevertToSnapshot_Task>
  </soap:Body>
</soap:Envelope>
 
SOAP_VMSNAPSHOTREVERT_MESSAGE
 
	return $msg;
}
 
 
sub createVMSnapShotRemoveMessage {
	my ($vmsnapshotid, $removeChildren) = @_;
	my $removeChildrenStr = "false";
	if ($removeChildren) { $removeChildrenStr = "true"; }
 
	my $msg = <<SOAP_VMSNAPSHOTREMOVE_MESSAGE;
 
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RemoveSnapshot_Task xmlns="urn:internalvim25">
      <_this xsi:type="ManagedObjectReference" type="VirtualMachineSnapshot" serverGuid="">$vmsnapshotid</_this>
      <removeChildren>$removeChildrenStr</removeChildren>
    </RemoveSnapshot_Task>
  </soap:Body>
</soap:Envelope>
 
SOAP_VMSNAPSHOTREMOVE_MESSAGE
 
	return $msg;
}
 
 
 
sub createVMSnapShotRevertToCurrentMessage {
	my $msg = <<SOAP_VMSNAPSHOTREREVERTTOCURRENT_MESSAGE;
 
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RevertToCurrentSnapshot_Task xmlns="urn:internalvim25">
      <_this xsi:type="ManagedObjectReference" type="VirtualMachine" serverGuid="">$vmid</_this>
    </RevertToCurrentSnapshot_Task>
  </soap:Body>
</soap:Envelope>
 
SOAP_VMSNAPSHOTREREVERTTOCURRENT_MESSAGE
 
	return $msg;
}
 
 
sub createVMResetMessage {
	my $msg = <<SOAP_VMRESET_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ResetVM_Task xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
    </ResetVM_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMRESET_MESSAGE
 
	return $msg;
}
 
 
sub createVMRestartMessage {
	my $msg = <<SOAP_VMRESTART_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RebootGuest xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
    </RebootGuest>
  </soap:Body>
</soap:Envelope>
SOAP_VMRESTART_MESSAGE
 
	return $msg;
}
 
 
sub createVMShutdownMessage {
	my $msg = <<SOAP_VMSHUTDOWN_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <ShutdownGuest xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
    </ShutdownGuest>
  </soap:Body>
</soap:Envelope>
SOAP_VMSHUTDOWN_MESSAGE
 
	return $msg;
}
 
 
sub createVMSuspendMessage {
	my $msg = <<SOAP_VMSUSPEND_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <SuspendVM_Task xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
    </SuspendVM_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMSUSPEND_MESSAGE
 
	return $msg;
}
 
 
sub createVMPowerOnMessage {
	my $msg = <<SOAP_VMPOWERON_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <PowerOnVM_Task xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
    </PowerOnVM_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMPOWERON_MESSAGE
 
	return $msg;
}
 
 
sub createVMPowerOffMessage {
	my $msg = <<SOAP_VMPOWERON_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <PowerOffVM_Task xmlns="urn:internalvim25">
      <_this xsi:type="VirtualMachine" type="VirtualMachine" serverGuid="">$vmid</_this>
    </PowerOffVM_Task>
  </soap:Body>
</soap:Envelope>
SOAP_VMPOWERON_MESSAGE
 
	return $msg;
}
 
 
sub createRescanAllHbaMessage {
	my $msg = <<SOAP_RESCANHBA_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RescanAllHba xmlns="urn:internalvim25">
      <_this xsi:type="ManagedObjectReference" type="HostStorageSystem" serverGuid="">storageSystem</_this>
    </RescanAllHba>
  </soap:Body>
</soap:Envelope>
SOAP_RESCANHBA_MESSAGE
 
	return $msg;
}
 
 
sub createRescanVmfsMessage {
	my $msg = <<SOAP_RESCANVMFS_MESSAGE;
<soap:Envelope xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <RescanVmfs xmlns="urn:internalvim25">
      <_this xsi:type="ManagedObjectReference" type="HostStorageSystem" serverGuid="">storageSystem</_this>
    </RescanVmfs>
  </soap:Body>
</soap:Envelope>
SOAP_RESCANVMFS_MESSAGE
 
	return $msg;
}
 
 
sub monitorStatus {
	my ($taskKey) = @_;
 
        my $continue = 0;
        my $taskpc = "";
	my $taskstate = "";
	my $outputneeded = 1;
        my ($info, $Task, $taskRef);
        my $error = 0;
 
	print "  Waiting for task ".$taskKey.":\n";
 
	# First find the task ref object since we only have the text key so far
 
	my $si_moref = ManagedObjectReference->new(type => 'ServiceInstance', value => 'ServiceInstance');
	my $si_view = Vim::get_view(mo_ref => $si_moref);
	my $sc_view = $si_view->RetrieveServiceContent();
	my $tm_view = Vim::get_view(mo_ref =>$sc_view->taskManager);
 
	if (defined $tm_view->recentTask) {
		foreach (@{$tm_view->recentTask}) {
			$Task = Vim::get_view(mo_ref => $_);
			if ($Task->info->key eq $taskKey) {
				$taskRef = $_;
				$continue = 1;
			}
		}
	}
 
	if (!$continue) {
		print "  Error: Couldn't find task in the recent tasks list\n";
		return 1;
	}
 
	$| = 1;  # Turn off buffering on STDOUT (otherwise \r doesn't work as stdout is line-buffered)
	sleep 3; # give any quick tasks a moment to run, to avoid hitting a 15-second wait below
 
	# Next poll the host periodically and display the task status as we go.
 
        my $task_view = Vim::get_view(mo_ref => $taskRef);
 
        while ($continue) {
        	$info = $task_view->info;
 
                if ($info->state->val eq 'success') {
			print "\r    - status: ".$info->state->val."            \n";
			my $message = "  Final status was ".$info->state->val;
			if (defined $info->progress) {
				$message = $message ." (".$info->progress."%)";
			}
			&writelog($message);
                        $continue = 0;
                } elsif ($info->state->val eq 'error') {
			if (defined $info->error->localizedMessage) {
				print "\n";
				&writelog ("  Task returned error - ".$info->error->localizedMessage);
			}
			$error = 1;
			$continue = 0;
                } else {
                	# No error, task is running
			if (defined $info->progress) {
				if ($info->progress ne $taskpc) {
					# update the status line
					$taskstate = $info->state->val;
					print "\r    - status: ".$taskstate;
					if (defined $info->progress) {
						$taskpc = $info->progress;
						print " (".$taskpc."%)";
					} else {
						print "        "; #ensure old status doesn't show through new
					}
					$outputneeded = 0;
				}
			}
                }
                if ($continue) {
                	# wait a bit then refresh the view, unless we are done
                	sleep 14;
                	$task_view->ViewBase::update_view_data();
                }
        }
	$| = 0;  # Set STDOUT back to line-buffered mode
	return $error;
}	
 
 
 
 
#####################################################################

#
# Helpers - cookie grab etc

#
#####################################################################

 
 
 
sub extractCookie {
	my ($rsp) = @_;
	my $cookie_jar = HTTP::Cookies->new;
        $cookie_jar->extract_cookies($rsp);
 
	return $cookie_jar;
}
 
sub checkReponse {
	my ($resp) = @_;
	my $ret = -1;	
 
	if($resp->code == 200) {
		return 1;
	} else {
		# print "\n".$resp->error_as_HTML."\n";
		return $ret;
	}
}
 
 
sub getTaskKey {
	my ($resp) = @_;
 
	my $start = index($resp,"<returnval type=\"Task\">") +23;
	my $end = index($resp,"</returnval>");
	my $len = $end - $start;
	my $key;
 
	if ($len) {
		$key = substr($resp, $start, $len);
	}
	else {
		$key = "";
	}
	return $key;
}
 
# Subroutine to process the input file

sub processFile {
        my ($hostlist) =  @_;
        my $HANDLE;
        open (HANDLE, $hostlist) or die("ERROR: Can not locate \"$hostlist\" input file!\n");
        my @lines = <HANDLE>;
        my @errorArray;
        my $line_no = 0;
 
        close(HANDLE);
        foreach my $line (@lines) {
                $line_no++;
                &TrimSpaces($line);
 
                if($line) {
                        if($line =~ /^\s*:|:\s*$/){
                                print "Error in Parsing File at line: $line_no\n";
                                print "Continuing to the next line\n";
                                next;
                        }
                        my $host = $line;
                        &TrimSpaces($host);
                        push @hostlist,$host;
                }
        }
}
 
sub TrimSpaces {
        foreach (@_) {
                s/^\s+|\s*$//g
        }
}
 
 
 
 
#####################################################################

#
# Helpers - generic code eg log writing, get date

#
#####################################################################

 
 
 
sub writelog {
# Appends specified text to the log file

# also displays on screen
	print "@_\n";
	open (LOGFILE, ">>$LOG_FILE");
	print LOGFILE "@_\n";
	close (LOGFILE); 
}
 
 
 
sub giveMeDate {
        my ($date_format) = @_;
        my %dttime = ();
	my $my_time;
        my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
 
        ### begin_: initialize DateTime number formats
        $dttime{year }  = sprintf "%04d",($year + 1900);  ## four digits to specify the year
        $dttime{mon  }  = sprintf "%02d",($mon + 1);      ## zeropad months
        $dttime{mday }  = sprintf "%02d",$mday;           ## zeropad day of the month
        $dttime{wday }  = sprintf "%02d",$wday + 1;       ## zeropad day of week; sunday = 1;
        $dttime{yday }  = sprintf "%02d",$yday;           ## zeropad nth day of the year
        $dttime{hour }  = sprintf "%02d",$hour;           ## zeropad hour
        $dttime{min  }  = sprintf "%02d",$min;            ## zeropad minutes
        $dttime{sec  }  = sprintf "%02d",$sec;            ## zeropad seconds
        $dttime{isdst}  = $isdst;
 
        if($date_format eq 'MDYHMS') {
                $my_time = "$dttime{mon}-$dttime{mday}-$dttime{year} $dttime{hour}:$dttime{min}:$dttime{sec}";
        }
        elsif ($date_format eq 'YMD') {
                $my_time = "$dttime{year}-$dttime{mon}-$dttime{mday}";
        }
        elsif ($date_format eq 'DMY') {
                $my_time = "$dttime{mday}-$dttime{mon}-$dttime{year}";
        }
        elsif ($date_format eq 'HMS') {
                $my_time = "$dttime{hour}:$dttime{min}:$dttime{sec}";
        }
        return $my_time;
}
 
sub commify {
    local($_) = shift;
    1 while s/^(-?\d+)(\d{3})/$1,$2/;
    return $_;
} 
 
 
####################

## END OF SCRIPT
####################

```


