<?php

class HtmlSelectElement extends HtmlFormControlElement
implements IHtmlInnerHtml
{
	public $Name;
	public $Disabled;
	public $Children;
	public $Selected;
	
	public function __construct($name, 
		array $children = [], 
		$selected = null,
		$disabled = false,
		$context = 'POST')
	{
		$this->Name = $name;
		$this->Disabled = $disabled;
		$this->Children = $children;
		$value = $this->GetUserValue($context);
		$this->SetSelected(($value == null) ? $selected : $value);
	}
	
	public function SetSelected($value) {
		foreach($this->Children as $child) {
			$optionValue = ($child->Value == null) ? $child->Text : $child->Value;
			if ($optionValue == $value) {
				$child->Selected = true;
				$this->Selected = $optionValue;
				return;
			}
		}
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