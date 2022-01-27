<?php

function registerNewUser(){
    if(isset($_POST['email'])){
    $cryptedPass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $arr_clients= array("name" =>$_POST["name"],"email"=> $_POST["email"], "password" => $cryptedPass );
    // $json_string = json_encode($arr_clients);
    print_r ($arr_clients);
    $file=("../../resources/users.json");
    $Allusers= file_get_contents($file);
    $usersAll= json_decode($Allusers);
    // print_r($Allusers);
    array_push($usersAll , $arr_clients);
    print_r($usersAll);
    $jsonUsers= json_encode($usersAll);
    file_put_contents($file, $jsonUsers);
    $nombreUser= $_POST['email'];
    mkdir("../../root/$nombreUser",0777);
/*     header(("Location:../../index.php"));
 */}
}

function validatePassword(){
        $fil="../../resources/users.json";
    $Allusers= file_get_contents($fil);
    $usersAll= json_decode($Allusers);
    if (($_POST)){
        $postEmail= $_POST["email"];
        $postPassword= $_POST["password"];
        header(("Location: ../../index.php?InvalidCredential"));
        foreach ($usersAll as $users) {
            foreach ($users as $key) {
                if($postEmail == $key->email){
                    if(password_verify($postPassword, $key->password)){
                        session_start();
                        $_SESSION['LAST_ACTIVITY'] = time();
                        $_SESSION["email"]= $key->email;
                        $_SESSION["user"]= $key->name;
                        header("Location: ../dashboard.php");
                        exit();
                    }
                }
            }
        }
    }
}

function exitSession(){
        session_start();
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
    header("Location: ../../index.php");
}