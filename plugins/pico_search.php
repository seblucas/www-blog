<?php

/**
 * Search inside all pages for Pico
 *
 * @author Sébastien Lucas
 * @link none
 * @license http://opensource.org/licenses/MIT
 */
class Pico_Search {

	private $is_search;
	private $search;

	public function __construct(){
		$this->is_search = false;
	}

	public function request_url(&$url)
	{
		if(preg_match ("/search\/(.*)/", $url, $matches)) {
			$this->is_search = true;
			$this->search = $matches [1];
		}
	}
	
	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page){
		if($this->is_search){
			// Execute grep
			$search = $this->search;
			exec ("grep -cRi '{$search}' content/* | grep :[1-9]", $output);
			$results = array ();

			// Get all the files found by grep and put them in an array
			foreach ($output as $out) {
				list ($file, $number) = split (":", $out);
				$file=str_replace (".md", "", substr ($file, 7));
				$results [$file] = $number;
			}

			$new_pages = array ();
			foreach ($pages as $page) {
				// if the page was found by grep then keep it
				if (array_key_exists ($page["url"], $results)) {
					array_push($new_pages, $page);
				}

			}

			$pages = $new_pages;
		}
	}

	public function before_render(&$twig_vars, &$twig) {
		if ($this->is_search) {
			// override 404 header
			header($_SERVER['SERVER_PROTOCOL'].' 200 OK');

			// set as front page, allows using the same navigation for index and tag pages
			$twig_vars["is_front_page"] = true;
			// sets page title to #TAG
			$twig_vars["meta"]["title"] = "/" . $this->search . "/";
		}
	}

}

?>