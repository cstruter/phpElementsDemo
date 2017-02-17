<?php

namespace CSTruter\Elements;

class HtmlSelectElement extends HtmlFormControlElement
{
	public $Disabled;
	public $AutoPostBack = false;
	public $OnClientChange = null;
	
	private $Name;
	private $Children;
	private $OptionValues = [];
	
	public function __construct($name, 
		array $children = [], 
		$value = null,
		$disabled = false,
		$requestMethod = null)
	{
		$this->Name = $name;
		$this->Disabled = $disabled;
		$userValue = $this->GetUserValue($requestMethod);
		$this->SetChildren($children, ($userValue === null) ? $value : $userValue);
	}

	private function setChild($child, $value) {
		$optionValue = (string)$child;
		$this->OptionValues[] = $optionValue;
		$child->Selected = ($optionValue == $value);
		if ($child->Selected) {
			$this->Value = $optionValue;
		}
	}
	
	public function GetName() {
		return $this->Name;
	}
	
	public function SetValue($value) {
		$this->OptionValues = [];
		foreach($this->Children as $child) {
			if ($child instanceof HtmlOptionElement) {
				$this->setChild($child, $value);
			} else if ($child instanceof HtmlOptionGroupElement) {
				$groupChildren = $child->GetChildren();
				foreach($groupChildren as $groupChild) {
					$this->setChild($groupChild, $value);
				}
			} else {
				throw new \Exception("Type of HtmlOptionElement expected in drop-down list $this->Name");
			}
		}
	}
	
	public function GetChildren() {
		return $this->Children;
	}
	
	public function SetChildren(array $children, $value = null)
	{
		$this->Children = $children;
		$this->SetValue($value);
		
		if (count($this->OptionValues) != count(array_unique($this->OptionValues))) {
			throw new \Exception("Non unique values assigned to drop-down list $this->Name");
		}		
	}
	
	public function Render($serializer = null)
	{
		$html = parent::Render($serializer);
		$scriptBlock = '';
		if ($this->AutoPostBack) {
			$scriptBlock.="CSTruter.Elements.DropDownList('$this->Name').AttachAutoPostBack();";
		}
		if ($this->OnClientChange !== null) {
			$scriptBlock.="CSTruter.Elements.DropDownList('$this->Name').On('change', $this->OnClientChange);";
		}
		if ($scriptBlock !== '') {
			$html.="<script type=\"text/javascript\">
			if (typeof CSTruter === 'undefined') { 
				throw 'Required JavaScript Library for Element $this->Name not found';
			} else { $scriptBlock }</script>";
		}
		return $html;
	}
}

?>