<?php

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerText,
	CSTruter\Elements\HtmlOptionElement;

class HtmlOptionSerializer 
implements IHtmlElement, IHtmlInnerText
{
	protected $element;
	
	public function __construct(HtmlOptionElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'disabled' => ($this->element->Disabled) ? '' : null,
			'selected' => ($this->element->Selected) ? '' : null,
			'value' => $this->element->Value
		];
	}

	public function GetTagName() {
		return 'option';
	}	
	
	public function GetInnerText() {
		return $this->element->Text;
	}
}

?>