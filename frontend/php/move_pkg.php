<?php 
/**
 * Module move_pkg.php
 * Mueve paquetes hacia otras distribuciones.
 * 
 * @author Francisco Javier Ramos Álvarez
 * @version 1.2
 * @package php
 * @see mvpkg.py by Antonio González Romero
 * 
 * @return $code
 */

	session_start();
	
	include_once('config.php');
	include_once('functions.php');
	require_once('myDebLog.class.php');
	
	set_time_limit(TIME_LIMIT);
	
	$repository = $_SESSION['repository']['name'];
	$dist_o = $_POST['dist_o']; //distro origen
	$dist_d = $_POST['dist_d']; //distro destino
	$comp = $_POST['comp'] ? '-C ' . $_POST['comp'] : '';
	$arch = $_POST['arch'];
	$msg_err = '';
	$ok = true;
	
	foreach($_POST['files'] as $pck => $filename){
		
		/** COMANDO ************************************************/
		$cmd = "$mv_pkg_py -p $filename -o $dist_o -d $dist_d $comp -a $arch -c $repo_conf -r $repository";
		$out_ret = execCmdV3($cmd);
		debugPython($cmd, $out_ret);
		
		$action = CPYPKG; //estamos copiando
		
		if(isset($_POST['del'])){
			$cmd = "$rm_pkg_py -p $filename -d $dist_o -a $arch -c $repo_conf -r $repository";
			$out_ret = execCmdV3($cmd);
			debugPython($cmd, $out_ret);
			
			$action = MOVPKG; //estamos moviendo
		}
		/***********************************************************/
		
		$bnf = basename($filename);
		if($out_ret[1] == 0){
			//registramos el movimiento
			registerMovement($action, array($bnf, $dist_o . ($action == CPYPKG ? '<=>' : '=>') . $dist_d));
			$ok = $ok and true;
		}
		else{
			include('msg_err_python.php');
			$msg_err .= "Error Cod. " . $out_ret[1] . "\n";
			$msg_err .= "Fichero: " . $bnf . "\n";
			$msg_err .= "Mensaje: " . $err_python[$out_ret[1]] . ".\n\n";
			$ok = false;
		}
	}
	
	echo ($ok ? 'OK' : $msg_err);
?>