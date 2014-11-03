<?php 

	extract( shortcode_atts( array(
			'text' 	=> 'button',
			'href'   => ''
		), $atts ) );

	ob_start();

	echo '<a class="button" href="' . $href .' "> ' . $text . ' </p>';

	$content = ob_get_contents();
	
 	ob_end_clean();

?>