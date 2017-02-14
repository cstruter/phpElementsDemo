<?php

namespace CSTruter\Elements;

use CSTruter\Serialization\Interfaces\IHtmlSerializer;

abstract class HtmlElement
{	
	public function Render(IHtmlSerializer $serializer = null) {
		if ($serializer == null) {
			$serializer = HtmlSettings::$Serializer;
		}
		return $serializer->Serialize($this);
	}
}

?>