<?php 
try{
    $bddPDO = new PDO('mysql:host=localhost;dbname=phblog','root','');
}
catch (PDOExcepton $e){
    echo "<p>Erreur:".$e->getMessage();
    die() ;
}
?>