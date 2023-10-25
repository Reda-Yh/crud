<?php
$dsn = 'mysql:host=localhost;dbname=madrid';
$username = 'root';
$password='';
try{
    $connection = new PDO($dsn,$username,$password,[]);
}
catch(PDOException $e)
{

}
$message = '';
?>
