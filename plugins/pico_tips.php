<?php

/**
 * Handle the former tips page
 *
 * @author Sébastien Lucas
 * @link none
 * @license http://opensource.org/licenses/MIT
 */
class Pico_Tips {

	private $redirect;

	public function __construct(){
		$this->redirect = false;
	}

	public function request_url(&$url)
	{
		if($url == 'fr/tips/start') $this->redirect = true;
		if($url == 'en/tips/start') $this->redirect = true;
		if($url == 'start') $this->redirect = true;
	}

	public function before_render(&$twig_vars, &$twig) {
		if ($this->redirect) {
			// override 404 header
			header($_SERVER['SERVER_PROTOCOL'].' 200 OK');

			// set as front page, allows using the same navigation for index and tag pages
			$twig_vars["is_front_page"] = true;
			// sets page title to #TAG
			$twig_vars["meta"]["title"] = "";
		}
	}


}

?>