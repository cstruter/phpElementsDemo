<?php

namespace CSTruter\Elements;

abstract class HtmlFormControlElement extends HtmlElement
{
	protected $Value;
	
	public function GetValue() {
		return $this->Value;
	}
	
	abstract function SetValue($value);
	
	protected function GetUserValue($requestMethod = null)
	{
		$name = $this->GetName();
		if ($requestMethod == null) {
			$requestMethod = HtmlSettings::$RequestMethod;
		}
		if ($requestMethod == 'POST' && isset($_POST[$name])) {
			return htmlspecialchars_decode($_POST[$name]);
		} else if ($requestMethod == 'GET' && isset($_GET[$name])) {
			return htmlspecialchars_decode($_GET[$name]);
		}
		return null;
	}	
}

?>