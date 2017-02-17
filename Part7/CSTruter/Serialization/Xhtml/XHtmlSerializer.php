<?php

namespace CSTruter\Serialization\Xhtml;

use CSTruter\Serialization\Interfaces\IHtmlSerializer,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Serialization\Interfaces\IHtmlInnerText,
	CSTruter\Serialization\Html\HtmlSerializer,
	CSTruter\Elements\HtmlElement,
	CSTruter\Elements\HtmlSelectElement,
	CSTruter\Elements\HtmlOptionElement,
	CSTruter\Elements\HtmlOptionGroupElement;

class XHtmlSerializer extends HtmlSerializer
{	
	public function Serialize(HtmlElement $element)
	{
		$serializer = $this->getSerializer($element);
		$tagName = $serializer->GetTagName();
		$html = "<$tagName";
		$html.= $this->getAttributeHtml($serializer);
		if ($this->isVoidElement($serializer)) {
			$html.= ' />';
		} else {
			$html.= '>';
			$html.= $this->getChildHtml($serializer);
			$html.= $this->getChildText($serializer);
			$html.= "</$tagName>";
		}
		return $html;
	}
	
	protected function getSerializer($element) {
		if ($element instanceof HtmlSelectElement) {
			return new XHtmlSelectSerializer($element);
		} else if ($element instanceof HtmlOptionElement) {
			return new XHtmlOptionSerializer($element);
		} else if ($element instanceof HtmlOptionGroupElement) {
			return new XHtmlOptionGroupSerializer($element);
		}
		throw new \Exception('No metadata found for element '.get_class($element));
	}
	
	protected function getAttributeHtml($serializer) {
		$html = '';
		$attributes = $serializer->GetAttributes();
		foreach($attributes as $attribute => $value) {
			if ($value !== null) {
				$html.=' '.strtolower($attribute).'="'.htmlspecialchars($value).'"';
			}
		}
		return $html;
	}
}

?>