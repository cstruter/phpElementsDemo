<?php

namespace CSTruter\Serialization\Xhtml;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerText,
	CSTruter\Serialization\Html\HtmlOptionSerializer,
	CSTruter\Elements\HtmlOptionElement;

class XHtmlOptionSerializer extends HtmlOptionSerializer
{
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
}

?>