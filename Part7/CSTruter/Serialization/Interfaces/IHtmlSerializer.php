<?php

namespace CSTruter\Serialization\Interfaces;

use CSTruter\Elements\HtmlElement;

interface IHtmlSerializer {
	function Serialize(HtmlElement $element);
}

?>