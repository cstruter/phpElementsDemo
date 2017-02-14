<?php

namespace CSTruter\Elements;

use CSTruter\Serialization\Xhtml\XHtmlSerializer;

class HtmlSettings
{
	public static $Serializer;
	public static $RequestMethod;
}

HtmlSettings::$Serializer = new XHtmlSerializer();
HtmlSettings::$RequestMethod = 'POST';

?>