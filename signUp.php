<?php
require 'connex.php';
$p=new crud('phblog','localhost','root','');
if(isset($_POST['sign-button'])){  
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $mobil=$_POST['mobil'];
    $lastname=$_POST['lastname'];
    $id=$_POST['id_role'];
    $confirmation_password=$_POST['confirmation_password'];

    if(!empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['id_role'])) {
        if($password == $confirmation_password) {
            $p->insertData($name,$lastname,$email,$password,$id,$mobil);
            echo "Register successful!";
        } else {
            echo "Passwords do not match!";
        }
    } else {
        echo "Please fill in all required fields!";
    }
}
?>
