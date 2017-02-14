<?php

class HtmlOptionElement
{
	public $Disabled;
	public $Selected;
	public $Value;
	public $Text;
	
	public function __construct($text, 
		$value = null, 
		$selected = false, 
		$disabled = false) 
	{
		$this->Text = $text;
		$this->Value = $value;
		$this->Selected = $selected;
		$this->Disabled = $disabled;
	}
}

?>