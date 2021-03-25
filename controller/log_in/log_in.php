<?php
    $alertText = "";
    function AlertText($status){
        switch($status){
            case "success-login": {
                return "Đăng Nhập Thành Công";
                break;
            }
            case "success-registered": {
                return "Đăng Ký Thành Công";
                break;
            }
            case "error-login": {
                return "Đăng Nhập Thất Bại";
                break;
            }
            case "error-login__username": {
                return "Tên tài khoản không chính xác";
                break;
            }
            case "error-login__password": {
                return "Mật khẩu không chính xác";
                break;
            }
            case "error-registered__username": {
                return "Tên tài khoản đã tồn tại";
                break;
            }
            case "error-registered__password": {
                return "Mật khẩu nhập lại không trùng khớp";
                break;
            }
            case "error-registered__membershipcode": {
                return "Mã nhân viên đã tồn tại";
                break; 
            }
            default: {
                return "";
                break;
            }
        }
    }
    function CheckSession(){
        return (isset($_SESSION['login'])) ? true : false;
    }
    function Login($username, $password, $conn){
        $newpassword = md5($password);
        $CheckName = $conn->SearchSessionData("personnel", "tentaikhoan", "\"$username\"");
        $CheckPass = $conn->SearchSessionData("personnel", "matkhau", "\"$newpassword\"");
        if(!$CheckName && $CheckPass){
            return AlertText("error-login__username");
        }
        else if(!$CheckPass && $CheckName){
            return AlertText("error-login__password");
        }
        else if($CheckName && $CheckPass){
            $id = $CheckName[0]['id'];
            $session = $conn->StartSession("personnel", $id, "tentaikhoan");
            $_SESSION['login'] = $session;
        }  
        else{
            return AlertText("error-login");
        }
        return AlertText("success-login");
    }
    if(isset($_GET['login'])){
        if(!CheckSession()){
        $login = $_GET['login'];
        if($login == "loging")
        require_once('./views/admin/login.php');
        }else header("location: index.php");
    }
    if(isset($_POST['login_submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];    
        $checkLG = Login($username, $password, $conn);
        $alertText = $checkLG;
    }
  
    if(isset($_GET['logout'])){
        session_unset();
        session_destroy();
        header("Refresh: 0 url=index.php");
    }
    if(isset($_SESSION['login'])){
        // $DataUser = $conn->GetData("personnel");
        $DataUser = $conn->SearchSessionData("personnel", "tentaikhoan", "\"{$_SESSION['login']}\"")[0];
        require_once("./views/index.php");
    }
    else if(!isset($_GET['login']) && !isset($_SESSION['login'])) {
        require_once("./views/index.php");
    }
?>