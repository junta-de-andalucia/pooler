<?php
/**
 * Module check_user_ldap.php
 * Realiza la autenticación, devolviendo OK si ha ido bien,
 * en caso contrario devolverá el código del error.
 * 
 * @author Francisco Javier Ramos Álvarez
 * @version 1.1
 * @package php
 * @see AuthLDAP.class.php
 * @see IniReader.class.php
 * 
 * @return $code
 */
	
	include_once('config.php');
	include_once('functions.php');
	require_once('AuthLDAP.class.php');
	require_once('IniReader.class.php');
	
	if(isset($_POST['login']) and isset($_POST['password'])){
		
		//autenticamos desde el fichero users_repository.ini si somos 
		//superusuario (admin) o no se realiza por LDAP
		if($_POST['login'] == 'admin' or !AUTH_LDAP){
			$inireader = new IniReader(USERS_INI);
			
			if($inireader->isOk()){
				$param = $inireader->getSection($_POST['login']);
				
				if(strcmp($param['password'], md5($_POST['password'])) == 0){
					//autenticación correcta por users_repository.ini
					session_start();
					
					if($_POST['login'] == 'admin')
						//añadimos parámetros de admin
						addParamAdmin(&$param);

					ldapOk($_POST['login'], $param);
					
				}
				else
					echo 'Password incorrecta.';
			}
			else
				echo $inireader->msg_err;
		}
		else{ //autenticación LDAP
			$objAuth = new AuthLDAP(
				$_POST['login'],
				$_POST['password']
			);
			
			/*
			$objAuth = new AuthLDAP(
				$_POST['login'],
				$_POST['password'],
				LDAP_SERVER,
				LDAP_PORT,
				DN_BASE
			);
			*/
			
			//nos logeamos
			if($objAuth->Login()){
			//if(true){
				//autenticación LDAP correcta
				session_start();
				
				//obtenemos permisos de usuario
				$inireader = new IniReader(USERS_INI);
				
				if($inireader->isOk()){
					$param = $inireader->getSection($_POST['login']);
					ldapOk($_POST['login'], $param);
				}
				else
					echo $inireader->msg_err;
			}
			else
				echo $objAuth->getMessageErr();
		}
	}
?>