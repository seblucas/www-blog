<?php

/**
 * Language plugin for Pico (adapted to my case)
 *
 * @author Sébastien Lucas
 * @link None for now
 * @license http://opensource.org/licenses/MIT
 */
class Pico_Language {
    private $current_lang;
    private $url;
    private $translations;
    private $languages = array ("en", "fr");

	public function plugins_loaded()
	{
		
	}

	public function config_loaded(&$settings)
	{
		
	}
	
	public function request_url(&$url)
	{
		$this->url = $url;
	}
	
	public function before_load_content(&$file)
	{
		
	}
	
	public function after_load_content(&$file, &$content)
	{
		
	}
	
	public function before_404_load_content(&$file)
	{
		
	}
	
	public function after_404_load_content(&$file, &$content)
	{
		
	}
	
	public function before_read_file_meta(&$headers)
	{
		$headers['language'] = 'Language';
	}
	
	public function file_meta(&$meta)
	{
		$this->current_lang = $meta['language'];
	}

	public function before_parse_content(&$content)
	{
		
	}
	
	public function after_parse_content(&$content)
	{
		
	}
	
	public function get_page_data(&$data, $page_meta)
	{
		
	}
	
	public function get_pages(&$pages, &$current_page, &$prev_page, &$next_page)
	{
		if (empty ($this->current_lang) || is_null ($this->url)) return;
        
        if (preg_match ("#/" . $this->current_lang . "/#", "/" . $this->url))
        {
            $this->translations = array ();
            foreach ($this->languages as $lang) {
                if ($lang == $this->current_lang)
                {
                    $this->translations[] = array ("name" => $lang, "url" => "#");
                    continue;
                }
                $other_url = str_replace ("/" . $this->current_lang . "/", "/{$lang}/", $current_page["url"]);
                $page_found = array_filter ($pages, function ($p) use ($other_url) {
                    return $p["url"] == $other_url;
                });
                if (count ($page_found) > 0) 
                {
                    $this->translations[] = array ("name" => $lang, "url" => $other_url);
                }
            }
            if (count ($this->translations) == 1) {
                $this->translations = null;
            }
        }
	}
	
	public function before_twig_register()
	{
		
	}
	
	public function before_render(&$twig_vars, &$twig, &$template)
	{
        if (!is_null ($this->translations)) {
            $twig_vars["meta"]["languages"] = $this->translations;
        }
		
	}
	
	public function after_render(&$output)
	{
		
	}
	
}

?>