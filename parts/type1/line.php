<?php 

	extract( shortcode_atts( array(
		'show' 	=> true
	), $atts ) );

	ob_start();

	echo '<hr />';

	$content = ob_get_contents();
	
 	ob_end_clean();

?>