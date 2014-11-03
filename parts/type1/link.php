<?php 

	extract( shortcode_atts( array(
			'text' 	=> 'text',
			'href'   => ''
		), $atts ) );

	ob_start();

	echo '<a href="' . $href .' "> ' . $text . ' </a>';

	$content = ob_get_contents();
	
 	ob_end_clean();

?>