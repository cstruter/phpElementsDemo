<?php

class HtmlSelectElement extends HtmlElement
implements IHtmlInnerHtml
{
	public $Name;
	public $Disabled;
	public $Children;
	
	public function __construct($name, 
		array $children = [], 
		$disabled = false)
	{
		$this->Name = $name;
		$this->Disabled = $disabled;
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