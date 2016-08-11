  <?php 
    function __autoload($className)
	{
		include_once 'classes/' . $className . '.php'; 
	}

    $htmlbuilder = new HTMLBuilder('header-partial.html','body-partial.html','footer-partial.html');

?>