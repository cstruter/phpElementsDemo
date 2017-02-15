<?php

namespace CSTruter\Serialization\Xhtml;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Elements\HtmlOptionGroupElement;

class XHtmlOptionGroupSerializer 
implements IHtmlElement, IHtmlInnerHtml
{
	private $element;
	
	public function __construct(HtmlOptionGroupElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'disabled' => ($this->element->Disabled) ? 'disabled' : null,
			'label' => $this->element->Label
		];
	}

	public function GetTagName() {
		return 'optgroup';
	}	
	
	public function GetInnerHtml() {
		return $this->element->GetChildren();
	}
}

?>