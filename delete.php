<?php 
require('connexion.php');
$id = $_GET['id'];



$sql = "DELETE from chantier where chantierID=:chantierID";
$statement = $connection -> prepare($sql);
$statement -> execute([':chantierID'=>$id]);


if($statement){
    header('location:4-tables.php?msg=chantier deleted successfully');
}

?>