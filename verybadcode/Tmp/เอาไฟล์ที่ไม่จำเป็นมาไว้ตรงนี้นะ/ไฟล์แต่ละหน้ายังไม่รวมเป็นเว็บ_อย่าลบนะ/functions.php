<?php

define ('DB_SERVER', 'localhost');//host
define ('DB_USER', 'root');//uesr
define ('DB_PASS', '');//pass
define ('DB_NAME', 'register_oop');//database

class DB_con{
    function __contruct(){
        $conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
        $this->dbcon = $conn;

        if(mysqli_connect_errno()){
            echo "Failed to connect to MySQL : ". mysqli_connect_error();
        } 
    
    }
    public function usernameavailable($uname){
        $checkuser = mysqli_query($this->dbcon, "SELECT username FORM tblusers WHERE username = '$uname'");
        return $checkuser;
    }

    
    public function registration($fname,$uname,$uemail,$password){
        $reg = mysqli_query($this->dbcon,"INSERT INTO tblusers(fullname,username,usermail,password) 
        VALUES('$fname','$uname','$uemail,'$password')");
        return $reg;
    }
    public function signin($uname,$password){
        $signinquery = mysqli_query($this->dbcon,"SELECT id,fullname FORM tblusers WHERE username ='$uname' AND password = '$password'");

    }
}
?>