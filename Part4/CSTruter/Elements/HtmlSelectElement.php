<?php

namespace CSTruter\Elements;

use CSTruter\Interfaces\IHtmlInnerHtml;

class HtmlSelectElement extends HtmlFormControlElement
implements IHtmlInnerHtml
{
	public $Disabled;
	
	private $Name;
	private $Children;
	
	public function __construct($name, 
		array $children = [], 
		$value = null,
		$disabled = false,
		$context = 'POST')
	{
		$this->Name = $name;
		$this->Disabled = $disabled;
		$userValue = $this->GetUserValue($context);
		$this->SetChildren($children, ($userValue === null) ? $value : $userValue);
	}

	private function setChild($child, $value) {
		$optionValue = (string)$child;
		$child->Selected = ($optionValue == $value);
		if ($child->Selected) {
			$this->Value = $optionValue;
		}
	}
	
	public function GetName() {
		return $this->Name;
	}
	
	public function SetValue($value) {
		foreach($this->Children as $child) {
			$this->setChild($child, $value);
		}
	}
	
	public function GetChildren() {
		return $this->Children;
	}
	
	public function SetChildren(array $children, $value = null)
	{
		foreach($children as $child) {
			if ($child instanceof HtmlOptionElement) {
				$this->setChild($child, $value);
			} else {
				throw new Exception("Type of HtmlOptionElement expected in drop-down list $this->Name");
			}
		}
		
		if (count($children) != count(array_unique($children))) {
			throw new Exception("Non unique values assigned to drop-down list $this->Name");
		}
		
		$this->Children = $children;
	}
	
	public function GetAttributes() {
		return [
			'name' => $this->Name,
			'disabled' => ($this->Disabled) ? 'disabled' : null
		];
	}
	
	public function GetTagName() {
		return 'select';
	}
	
	public function GetInnerHtml() {
		return $this->Children;
	}
}

?>