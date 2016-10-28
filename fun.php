<?php
class fun {

    function logTest (){

        if (empty(@$_GET['id']) or empty(@$_GET['myid'])) {
            die("<script>alert('非法登入！！');window.history.back();</script>");
        }
        session_start();
        if (empty(@$_SESSION['uid'])) {
            die("<script>alert('登陆超时！');window.location='login.html';</script>");
        }
        if ($_GET['myid'] != $_SESSION['uid']) {
            header("Location:index.php?myid=$_SESSION[uid]");
        }
    }

    function connect(){
        try{
            $pdo=new PDO("mysql:host=localhost;dbname=test","root","");
            $pdo->query("SET NAMES UTF8");
        }catch(PDOException $e){
            die( "链接数据失败".$e->getMessage());
        }

  }
}


?>