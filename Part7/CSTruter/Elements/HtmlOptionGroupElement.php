<?php


namespace CSTruter\Elements;

class HtmlOptionGroupElement extends HtmlElement
{
	private $Children;
	public $Disabled;
	public $Label;

	public function __construct($label,
		array $children = [], 
		$disabled = false) 
	{
		$this->Label = $label;
		$this->Disabled = $disabled;
		$this->Children = $children;
	}
	
	public function GetChildren() {
		return $this->Children;
	}
}


?>