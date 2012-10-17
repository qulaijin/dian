<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function show_message($message,$actionurl=array(),$target='_self'){
	ob_start();
	include(APPPATH.'views/public/message.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	echo $buffer;exit;
}
?>
