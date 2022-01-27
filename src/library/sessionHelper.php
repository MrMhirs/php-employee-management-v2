<?php
require_once('./loginManager.php');

/* 10 MUNUTES LOGOUT */
if ((time()-$_SESSION['LAST_ACTIVITY']) >= 600 ) {
        unset($_SESSION);
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }else {

    }


/* BUTTON LOGOUT */
if(isset($_GET["closeSession"])){
    exitSession();
}