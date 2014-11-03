<?php 

	extract( shortcode_atts( array(
			'text' 	=> ''
		), $atts ) );

	ob_start();

	echo '<p>Something</p>';

	$content = ob_get_contents();
	
 	ob_end_clean();

?>