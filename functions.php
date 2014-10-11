<?php
session_start();
setlocale(LC_ALL, 'tr_TR');
date_default_timezone_set("Europe/Istanbul");

/* CHECK_LOGIN_DIE | Access control, die if needed */
function check_login_die(){
	if ($_SESSION['user'] != "supervisor"){
		echo "Access denied.";
		die;
	}else{
		return;
	}
}

/* CHECK_LOGIN | Just casually check if access granted or not */
function check_login(){
	if ($_SESSION['user'] != "supervisor"){
		return FALSE;
	}else{
		return TRUE;
	}
}

?>