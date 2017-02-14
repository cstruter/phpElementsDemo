<?php

namespace CSTruter\Elements;

class HtmlOptionElement extends HtmlElement
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
	
	public function __toString() {
        return (string)(($this->Value == null) ? $this->Text : $this->Value);
    }
}

?>