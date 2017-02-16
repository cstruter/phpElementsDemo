<?php

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlElement,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Elements\HtmlSelectElement;

class HtmlSelectSerializer 
implements IHtmlElement, IHtmlInnerHtml
{
	protected $element;
	
	public function __construct(HtmlSelectElement $element) {
		$this->element = $element;
	}
	
	public function GetAttributes() {
		return [
			'name' => $this->element->GetName(),
			'disabled' => ($this->element->Disabled) ? '' : null
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