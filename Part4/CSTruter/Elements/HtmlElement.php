<?php

namespace CSTruter\Elements;

use CSTruter\Interfaces\IHtmlInnerHtml,
	CSTruter\Interfaces\IHtmlInnerText;

abstract class HtmlElement
{
	abstract public function GetAttributes();
	
	abstract public function GetTagName();
	
	public function Render()
	{
		$tagName = $this->GetTagName();
		$html = "<$tagName";
		$html.= $this->getAttributeHtml();
		if ($this->isVoidElement()) {
			$html.=' />';
		} else {
			$html.='>';
			$html.= $this->getChildHtml();
			$html.= $this->getChildText();
			$html.= "</$tagName>";
		}
		return $html;
	}
	
	private function getAttributeHtml() {
		$html = '';
		$attributes = $this->GetAttributes();
		foreach($attributes as $attribute => $value) {
			if ($value != null) {
				$html.=' '.strtolower($attribute).'="'.htmlspecialchars($value).'"';
			}
		}
		return $html;
	}
	
	private function getChildHtml() {
		$html = '';
		if ($this instanceof IHtmlInnerHtml) {
			$children = $this->GetInnerHtml();
			foreach($children as $child) {
				if ($child instanceof HtmlElement) {
					$html.=$child->Render();
				}
			}
		}
		return $html;
	}
	
	private function getChildText() {
		if ($this instanceof IHtmlInnerText) {
			return htmlentities($this->GetInnerText());
		}
		return '';
	}
	
	private function isVoidElement() {
		return !($this instanceof IHtmlInnerText || $this instanceof IHtmlInnerHtml);
	}
}

?>