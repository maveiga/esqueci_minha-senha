<?php
try{
    $pdo = new PDO("mysql:dbname=youtube;host=localhost","root","");

}catch(PDOException $e) {
    "erro" . $e->getMessage();
    exit;
}

