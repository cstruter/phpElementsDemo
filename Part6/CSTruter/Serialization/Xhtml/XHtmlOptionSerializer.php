<?php

namespace CSTruter\Serialization\Xhtml;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerText,
	CSTruter\Elements\HtmlOptionElement;

class XHtmlOptionSerializer 
implements IHtmlElement, IHtmlInnerText
{
	private $element;
	
	public function __construct(HtmlOptionElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'disabled' => ($this->element->Disabled) ? 'disabled' : null,
			'selected' => ($this->element->Selected) ? 'selected' : null,
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