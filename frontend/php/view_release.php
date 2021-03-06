<?php
/**
 * Frame view_release.php
 * Mostrará el contenido de los ficheros Release.
 * 
 * @author Francisco Javier Ramos Álvarez
 * @version 1.0
 * @package php
 * 
 * @return html
 */
	
	if(isset($_GET['path']) and !empty($_GET['path'])){
		$path = $_GET['path'];
		if(ereg('.gpg$', $path)){
			//mostrará las firmas
			include('functions.php');
			die(nl2br(extractFile($path)));
		}
		else{
			require_once('FileInfo.class.php');
			
			//cargamos el fichero
			$release = new FileInfo($path);
			
			//Construimos una tabla para mostrar los datos
			$block = $release->getBlockInfo(0);
			$datas = $block->getDatas();
			echo '<table class="table1">';
			foreach($datas as $field => $value){
				echo '<tr>';
				if(strcmp($field, 'MD5Sum') == 0 or strcmp($field, 'SHA1') == 0){
					echo '<td valign="top"><strong>' . $field . ':<strong></td>';
					echo '<td>';
					
					$checks = explode("\n", trim($value));
					
					echo '<table width="700" class="table1">';
					foreach($checks as $value){
						$lensum = strpos($value, ' ');
						echo '<tr>';
						echo '<td>' . substr($value, 0, $lensum) . '</td>';
						
						$chkdatas = explode(' ', trim(substr($value, $lensum)));
						echo '<td align="right">' . $chkdatas[0] . '</td>';
						echo '<td width="20"></td>';
						echo '<td>' . $chkdatas[1] . '</td>';
						echo '</tr>';
					}
					echo '</table>';
					
					
					echo '</td>';
				}
				else{
					echo '<td><strong>' . $field . ':<strong></td>';
					echo '<td>' . nl2br($value) . '</td>';
				}
				echo '</tr>';
			}
			echo '</table>';
		}
	}
?>