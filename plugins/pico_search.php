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
            $new_pages = array ();
			foreach ($pages as $page) {
                if (preg_match ("/" . $this->search . "/", $page["content"])) {
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