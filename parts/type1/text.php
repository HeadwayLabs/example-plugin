<?php 

	extract( shortcode_atts( array(
			'text' 	=> 'text'
		), $atts ) );

	ob_start();

	echo '<p> ' . $text . ' </p>';

	$content = ob_get_contents();
	
 	ob_end_clean();

?>