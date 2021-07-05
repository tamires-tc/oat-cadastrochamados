<?php

if(!empty($_POST)){
    $email = $_POST["email"];
    echo($email);
    $senha = md5($_POST["senha"]);
    echo($senha);
    $sql = "SELECT id, nome, email, telefone FROM usuarios WHERE email = '".$email."' and senha = '".$senha."'";

    $result = $conn->query($sql, PDO::FETCH_ASSOC);
    if($info = $result->fetch()){
        $_SESSION["nome"]=$info['nome'];
        $_SESSION["email"]=$info['email'];
        $_SESSION["telefone"]=$info['telefone'];
        $_SESSION["id"] = $info['id'];
    header("Location: ?pg=chamado/chamados");
    }else{
        echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Usuário não encontrado.</p></div>';
    }
}
?>

