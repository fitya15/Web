<?php
//connect to the database
//mysqli is php 7
session_start();
$username="";
$email="";
$errors=array();

$db=mysqli_connect('localhost','root','','registrationdb');

//if the register button is clicked
if(isset($_POST['register'])){
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $password_1=mysqli_real_escape_string($db,$_POST['password_1']);
    $password_2=mysqli_real_escape_string($db,$_POST['password_2']);
    
    
    //ensure that form fields are filled properly
    if(empty($username)){
        array_push($errors,"Username is required");
    }
    if(empty($email)){
        array_push($errors,"Email is required");
    }
    if(empty($password_1)){
        array_push($errors,"Password is required");
    }

    if($password_1 != $password_2)
    {
        array_push($errors,"Password did not match");
    }

    $query="SELECT * FROM users WHERE username='$username'";
        $result=mysqli_query($db,$query);
              //query variable  
              if(mysqli_num_rows($result)==1){
                array_push($errors,"Username Already exist");
              }

              

    //if there are no error save to database  
    if(count($errors) == 0)
    {
        //$password=md5($password_1);
        $password=$password_1;
        //syntax is $sql="INSERT INTO _tablename_ (dbname,dbname,dbname)
        // VALUES('$variabledb','$variabledb','$variabledb')";
        $sql="INSERT INTO users (username,email,password) 
              VALUES('$username','$email','$password')";

              //query variable
              mysqli_query($db,$sql);
              $_SESSION['username'] = $username;
              $_SESSION['success']="You're Logged In";
              header('location: index.php');
    }

}

//if the login button is clicked
//check data to match with database
if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($db,$_POST['username']);
    $password=mysqli_real_escape_string($db,$_POST['password']);

    //ensure that form fields are filled properly
    if(empty($username)){
        array_push($errors,"Username is required");
    }
    if(empty($password)){
        array_push($errors,"Password is required");
    }

    

    //if there are no error save to database  
    if(count($errors) == 0)
    {

        //$password=md5($password);
        $query="SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result=mysqli_query($db,$query);
              //query variable
              if(mysqli_num_rows($result)==1){
                  $_SESSION['username'] = $username;
                  $_SESSION['success']="You're Logged In";
                  header('location: index.php');
              }
              else{
                  array_push($errors,"invalid username/password");
              }
    }

}

//logout
if(isset($_GET['logout']))
{
  session_destroy();
  unset($_SESSION['username']);
  header('location:login.php');
}


?>