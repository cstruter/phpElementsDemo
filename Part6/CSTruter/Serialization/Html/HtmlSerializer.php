<?php

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlSerializer,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Serialization\Interfaces\IHtmlInnerText,
	CSTruter\Elements\HtmlElement,
	CSTruter\Elements\HtmlSelectElement,
	CSTruter\Elements\HtmlOptionElement,
	CSTruter\Elements\HtmlOptionGroupElement;

class HtmlSerializer
implements IHtmlSerializer
{	
	public function Serialize(HtmlElement $element)
	{
		$serializer = $this->getSerializer($element);
		$tagName = $serializer->GetTagName();
		$html = "<$tagName";
		$html.= $this->getAttributeHtml($serializer);
		if ($this->isVoidElement($serializer)) {
			$html.= ' >';
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
			return new HtmlSelectSerializer($element);
		} else if ($element instanceof HtmlOptionElement) {
			return new HtmlOptionSerializer($element);
		}  else if ($element instanceof HtmlOptionGroupElement) {
			return new HtmlOptionGroupSerializer($element);
		}
		throw new \Exception('No metadata found for element '.get_class($element));
	}
	
	protected function getAttributeHtml($serializer) {
		$html = '';
		$attributes = $serializer->GetAttributes();
		foreach($attributes as $attribute => $value) {
			if ($value === '') {
				$html.=' '.strtolower($attribute);
			} else if ($value !== null) {
				$html.=' '.strtolower($attribute).'="'.htmlspecialchars($value).'"';
			}
		}
		return $html;
	}
	
	protected function getChildHtml($serializer) {
		$html = '';
		if ($serializer instanceof IHtmlInnerHtml) {
			$children = $serializer->GetInnerHtml();
			foreach($children as $child) {
				if ($child instanceof HtmlElement) {
					$html.=$child->Render($this);
				}
			}
		}
		return $html;
	}
	
	protected function getChildText($serializer) {
		$html = '';
		if ($serializer instanceof IHtmlInnerText) {
			$html.= htmlentities($serializer->GetInnerText());
		}
		return $html;
	}
	
	protected function isVoidElement($serializer) {
		return !($serializer instanceof IHtmlInnerText || $serializer instanceof IHtmlInnerHtml);
	}
}

?>