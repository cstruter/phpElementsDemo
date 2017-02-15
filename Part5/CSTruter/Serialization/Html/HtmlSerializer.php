<?php

namespace CSTruter\Serialization\Html;

use CSTruter\Serialization\Interfaces\IHtmlSerializer,
	CSTruter\Serialization\Interfaces\IHtmlInnerHtml,
	CSTruter\Serialization\Interfaces\IHtmlInnerText,
	CSTruter\Elements\HtmlElement,
	CSTruter\Elements\HtmlSelectElement,
	CSTruter\Elements\HtmlOptionElement;

class HtmlSerializer
implements IHtmlSerializer
{
	private $serializer;
	
	public function Serialize(HtmlElement $element)
	{
		$this->serializer = $this->getSerializer($element);
		$tagName = $this->serializer->GetTagName();
		$html = "<$tagName";
		$html.= $this->getAttributeHtml();
		if ($this->isVoidElement()) {
			$html.= ' >';
		} else {
			$html.= '>';
			$html.= $this->getChildHtml();
			$html.= $this->getChildText();
			$html.= "</$tagName>";
		}
		return $html;
	}
	
	private function getSerializer($element) {
		if ($element instanceof HtmlSelectElement) {
			return new HtmlSelectSerializer($element);
		} else if ($element instanceof HtmlOptionElement) {
			return new HtmlOptionSerializer($element);
		}
		return null;
	}
	
	private function getAttributeHtml() {
		$html = '';
		$attributes = $this->serializer->GetAttributes();
		foreach($attributes as $attribute => $value) {
			if ($value === '') {
				$html.=' '.strtolower($attribute);
			} else if ($value !== null) {
				$html.=' '.strtolower($attribute).'="'.htmlspecialchars($value).'"';
			}
		}
		return $html;
	}
	
	private function getChildHtml() {
		$html = '';
		if ($this->serializer instanceof IHtmlInnerHtml) {
			$children = $this->serializer->GetInnerHtml();
			foreach($children as $child) {
				if ($child instanceof HtmlElement) {
					$html.=$child->Render($this);
				}
			}
		}
		return $html;
	}
	
	private function getChildText() {
		$html = '';
		if ($this->serializer instanceof IHtmlInnerText) {
			$html.= htmlentities($this->serializer->GetInnerText());
		}
		return $html;
	}
	
	private function isVoidElement() {
		return !($this->serializer instanceof IHtmlInnerText || $this->serializer instanceof IHtmlInnerHtml);
	}
}

?>