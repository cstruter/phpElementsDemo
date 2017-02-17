<?php

namespace CSTruter\Serialization\Xhtml;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Serialization\Html\HtmlOptionGroupSerializer,
	CSTruter\Elements\HtmlOptionGroupElement;

class XHtmlOptionGroupSerializer extends HtmlOptionGroupSerializer
{
	public function __construct(HtmlOptionGroupElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'disabled' => ($this->element->Disabled) ? 'disabled' : null,
			'label' => $this->element->Label
		];
	}
}

?>