<?php

class HtmlSelectElement
{
	public $Name;
	public $Disabled;
	public $Children;
	
	public function __construct($name, 
		array $children = [], 
		$disabled = false)
	{
		$this->Name = $name;
		$this->Disabled = $disabled;
		$this->Children = $children;
	}
}

?>