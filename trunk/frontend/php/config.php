<?php

	//configuración para python
	define('REPO_CONF', '/etc/poolmanager/repo.conf'); $repo_conf = REPO_CONF;
	define('ADD_PKG_PY', '/usr/share/poolmanager/bin/addpkg.py'); $add_pkg_py = ADD_PKG_PY;
	define('MV_PKG_PY', '/usr/share/poolmanager/bin/mvpkg.py'); $mv_pkg_py = MV_PKG_PY;
	define('RM_PKG_PY', '/usr/share/poolmanager/bin/rmpkg.py'); $rm_pkg_py = RM_PKG_PY;
	
	//otras constantes
	define('PATH_REPOSITORY', '/home/fran/repositorios/guadalinex-flamenco');
	define('USERS_INI', '/var/www/debmanager/other/users_repository.ini');
	define('PATH_LOG', '/var/www/debmanager/logs');
	define('PATH_TEMP', '/var/www/debmanager/tmp');
	
	//acciones de paquetes
	define('ADDPKG', 'addpkg');
	define('MOVPKG', 'movpkg');
	define('DELPKG', 'delpkg');
	
	//acciones con fuentes
	define('ADDSRC', 'addsrc');
	define('MOVSRC', 'movsrc');
	define('DELSRC', 'delsrc');
	
	//acciones de login
	define('LOGIN', 'login');
	define('LOGOUT', 'logout');
	
	//acciones de usuarios
	define('ADDUSER', 'adduser');
	define('EDTUSER', 'edtuser');
	define('DELUSER', 'deluser');
	
	//campos de filtrado
	$fieldsFilter = array(
		'Package',
		'Version',
		'Maintainer',
		'Architecture',
		'Depends',
		'Conflicts',
		'Description'
	);
?>