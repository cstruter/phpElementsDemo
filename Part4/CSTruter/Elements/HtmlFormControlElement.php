<?php

namespace CSTruter\Elements;

abstract class HtmlFormControlElement extends HtmlElement
{
	protected $Value;
	
	public function GetValue() {
		return $this->Value;
	}
	
	abstract function SetValue($value);
	
	protected function GetUserValue($context = 'POST')
	{
		$name = $this->GetName();
		if ($context == 'POST' && isset($_POST[$name])) {
			return htmlspecialchars_decode($_POST[$name]);
		} else if ($context == 'GET' && isset($_GET[$name])) {
			return htmlspecialchars_decode($_GET[$name]);
		}
		return null;
	}	
}

?>