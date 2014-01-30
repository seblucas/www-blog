<?php

/**
 * Tags plugin
 * Adds ability to use "Tags:" field in post meta,
 * tags should be comma separeted without spaces
 * posts with given tag can be displayed when visiting
 * /tag/TAG URL
 *
 * @author Szymon Kaliski
 * @link http://treesmovethemost.com
 * @license http://opensource.org/licenses/MIT
 */

class Pico_Tags {
	private $base_url;
	private $current_url;
	private $current_tag;
	private $is_tag;
	private $current_meta;
	private $tag_cloud;

	// copied from pico source, $headers as array gives ability to add additional metadata, e.g. header image
	public function before_read_file_meta (&$headers) {
		$headers['tags'] = 'Tags';
	}

	public function plugins_loaded() {

	}

	public function request_url(&$url) {
		$this->current_url = $url;

		// substr first four letters, because "tag/" is four letters long
		$this->is_tag = (substr($this->current_url, 0, 4) == "tag/");
		if ($this->is_tag) $this->current_tag = substr($this->current_url, 4);
	}

	public function before_load_content(&$file) {

	}

	public function after_load_content(&$file, &$content) {

	}

	public function before_404_load_content(&$file) {

	}

	public function after_404_load_content(&$file, &$content) {

	}

	public function config_loaded(&$settings) {
		$this->base_url = $settings['base_url'];
	}
	
	private function handle_meta (&$meta)
	{
		// already handled
		if (array_key_exists ('tags', $meta) && is_array ($meta ['tags'])) {
			return;
		}
		
		// only set $headers['tags'] if there are any
		if (array_key_exists ('tags', $meta) && strlen($meta['tags']) > 1) {
			$meta['tags'] = explode(',', $meta['tags']);
		} else {
			$meta['tags'] = NULL;
		}
	}

	public function file_meta(&$meta) {
		$this->handle_meta ($meta);
		
		$this->current_meta = $meta;
	}

	public function content_parsed(&$content) {

	}

	public function get_page_data(&$data, $page_meta)
	{
		$this->handle_meta ($page_meta);
		$data ['tags'] = $page_meta ['tags'];
	}

	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page) {
		// display pages with current tag if visiting tag/ url
		// display only pages with tags when visiting index page
		// this adds possiblity to distinct tagged pages (e.g. blog posts),
		// and untagged (e.g. static pages like "about")
		
		$this->tag_cloud = array ();
		$tagList = array ();
		foreach ($pages as $page) {
			if (!is_array ($page ['tags'])) {
				continue;
			}
			foreach ($page ['tags'] as $tag) {
				if (array_key_exists ($tag, $tagList)) {
					$tagList [$tag]++;
				} else {
					$tagList [$tag] = 1;
				}
			}
		}
		ksort ($tagList);
		$max = max ($tagList);
		foreach ($tagList as $tag => $number) {
			$number = ceil ($number * 5 / $max);
			array_push ($this->tag_cloud, array ("name" => $tag, "rank" => $number));
		}
		

		$is_index = ($this->base_url == $current_page["url"]);

		if ($this->is_tag || $is_index) {
			$new_pages = array();

			foreach ($pages as $page) {
				$file_url = substr($page["url"], strlen($this->base_url));
				$file_name = CONTENT_DIR . $file_url . ".md";

				// get metadata from page
				if (file_exists($file_name)) {
					// append to pages array only if tags match, or if it's index page
					$tags = $page ['tags'];
					if (in_array($this->current_tag, $tags) || $is_index) {
						array_push($new_pages, $page);
					}
				}
			}

			$pages = $new_pages;
		}
	}

	public function before_twig_register() {

	}

	public function before_render(&$twig_vars, &$twig) {
		$twig_vars ["tagcloud"] = $this->tag_cloud;
		if ($this->is_tag) {
			// override 404 header
			header($_SERVER['SERVER_PROTOCOL'].' 200 OK');

			// set as front page, allows using the same navigation for index and tag pages
			$twig_vars["is_front_page"] = true;
			// sets page title to #TAG
			$twig_vars["meta"]["title"] = "#" . $this->current_tag;
		}
		else {
			// add tags to post meta
			$twig_vars["meta"] = array_merge($twig_vars["meta"], $this->current_meta);
		}
	}

	public function after_render(&$output) {

	}
}

?>
