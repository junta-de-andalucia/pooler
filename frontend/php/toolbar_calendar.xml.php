<?php
/**
 * 
 */

	session_start();
	include('functions.php');

/*****************************************************************************/
header("Content-type:text/xml"); 
echo '<?xml version="1.0" encoding="utf-8"?>';
echo '<toolbar name=" " width="250" toolbarAlign="left">';
	echo '<ImageTextButton src="../img/s_loggoff.png" height="25" width="25" id="but_calendar_1" tooltip="Salir" />';	
echo '</toolbar>';
/*****************************************************************************/

?>