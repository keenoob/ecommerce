<?php

namespace Ecommerce;

use Rain\Tpl;

class Page{

	private $tpl;
	private $options = [];
	private $defaults = [
		"header"=>true,
		"footer"=>true,
		"Data"=>[]
	]; 




	public function __construct($opts = array(), $tpl_dir = "views/")
	{

		$this->options = array_merge($this->defaults, $opts);
		$config = array(
			"tpl_dir"       => $tpl_dir,
			"cache_dir"     => 'views-cach/',
			"debug"			=> false
		);

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["Data"]);
		if ($this->options["header"] === true) {
			$this->tpl->draw("header");
		}
		
	}



	private function setData($data = array()) {
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
	}



	public function setTpl($name, $data = array(), $returnHtml = false)
	{

		$this->setData($data);

		$this->tpl->draw($name , $returnHtml);

	}

	public function __destruct()
	{

		if ($this->options["footer"] === true) {
			$this->tpl->draw("footer");
		}

	}

}