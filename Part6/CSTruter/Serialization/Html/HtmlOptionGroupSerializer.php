<?php

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Elements\HtmlOptionGroupElement;

class HtmlOptionGroupSerializer 
implements IHtmlElement, IHtmlInnerHtml
{
	protected $element;
	
	public function __construct(HtmlOptionGroupElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'disabled' => ($this->element->Disabled) ? '' : null,
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