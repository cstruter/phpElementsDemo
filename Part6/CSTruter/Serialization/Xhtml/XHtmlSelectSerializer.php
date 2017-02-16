<?php

namespace CSTruter\Serialization\Xhtml;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Serialization\Html\HtmlSelectSerializer,
	CSTruter\Elements\HtmlSelectElement;

class XHtmlSelectSerializer extends HtmlSelectSerializer
{
	public function __construct(HtmlSelectElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'name' => $this->element->GetName(),
			'disabled' => ($this->element->Disabled) ? 'disabled' : null
		];
	}
}

?>