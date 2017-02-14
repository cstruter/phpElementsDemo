<?php

class HtmlOptionElement extends HtmlElement
implements IHtmlInnerText
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
	
	public function GetAttributes() {
		return [
			'disabled' => ($this->Disabled) ? 'disabled' : null,
			'selected' => ($this->Selected) ? 'selected' : null,
			'value' => $this->Value
		];
	}

	public function GetTagName() {
		return 'option';
	}	
	
	public function GetInnerText() {
		return $this->Text;
	}
}

?>