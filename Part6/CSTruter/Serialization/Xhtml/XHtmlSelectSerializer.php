<?php

namespace CSTruter\Serialization\Xhtml;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Elements\HtmlSelectElement;

class XHtmlSelectSerializer 
implements IHtmlElement, IHtmlInnerHtml
{
	private $element;
	
	public function __construct(HtmlSelectElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'name' => $this->element->GetName(),
			'disabled' => ($this->element->Disabled) ? 'disabled' : null
		];
	}
	
	public function GetTagName() {
		return 'select';
	}
	
	public function GetInnerHtml() {
		return $this->element->GetChildren();
	}
}

?>