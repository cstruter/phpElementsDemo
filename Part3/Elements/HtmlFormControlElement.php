<?php

abstract class HtmlFormControlElement extends HtmlElement
{
	protected function GetUserValue($context = 'POST')
	{
		if ($context == 'POST' && isset($_POST[$this->Name])) {
			return htmlspecialchars_decode($_POST[$this->Name]);
		} else if ($context == 'GET' && isset($_GET[$this->Name])) {
			return htmlspecialchars_decode($_GET[$this->Name]);
		}
		return null;
	}	
}

?>