<?php

function __autoload($class) {
	require str_replace('\\', '/', $class).'.php';
}

use CSTruter\Elements\HtmlSelectElement,
	CSTruter\Elements\HtmlOptionElement;
	
$select = new HtmlSelectElement('friends', [
	new HtmlOptionElement('Not Selected', 0),
	new HtmlOptionElement('Gerhardt Stander', 1),
	new HtmlOptionElement('Bronwen Murdoch', 2),
	new HtmlOptionElement('Maree Kleu', 3)
],  3);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>PHP Drop-Down List - Part 4</title>
	</head>
	<body>
		<form method="POST">
			<?php echo $select->Render(); ?>
			<br>
			<input type="submit" value="Go">
		</form>
	</body>
</html>
