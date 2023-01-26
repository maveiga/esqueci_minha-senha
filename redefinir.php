<?php
require 'config.php';

if(!empty($_GET['token'])){
    $token = $_GET['token'];

    $sql = "SELECT * FROM usuarios_token WHERE hash=:hash AND used=0 AND expiradoem > NOW()";
    $sql = $pdo->prepare($sql);
    $sql->bindValue(":hash", $token);
    $sql->execute();


    if($sql->rowCount()>0){
        $sql = $sql->fetch();
        $id = $sql['id_usuario'];
        if(!empty($_POST['senha'])){
            $senha = $_POST['senha'];
            $sql = "UPDATE usuarios SET senha=:senha WHERE id=:id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":senha", md5($senha));
            $sql->bindValue(":id", $id);
            $sql->execute();
    
    
            $sql = "UPDATE usuarios_token SET used=1 WHERE hash=:hash";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":hash",$token);
            $sql->execute();
    
            echo "senha alterada com sucesso";
            exit;

        }
      
        
        ?>
        <form method="POST">
            Digite a nova senha
            <input type="password" name="senha"/><br/>
            <input type="submit" value="mudar senha"/>
        </form>
        <?php

    }else{
        echo "tokem invalido ou usado";
    }
}