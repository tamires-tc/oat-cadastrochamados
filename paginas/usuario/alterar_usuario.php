<?php

    $id = $_GET["id"];



if(!empty($_POST)){   
    $nome = $_POST["nome"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $data_hora_atualizacao = date('Y-m-d H:i:s');
    $usuario_resp= $_SESSION["nome"];
    $descricao = ("Alteração de usuario:".$id);
    $data_hora = date('Y-m-d H:i:s');    
    
    # Update no banco de dados
    $stmt = $conn->prepare("UPDATE usuarios set nome = :nome, usuario = :usuario,  senha = :senha, data_hora_atualizacao = :data_hora_atualizacao where id = :id");
    $stmt1 = $conn->prepare("INSERT INTO logs (usuario_resp, descricao, data_hora) VALUES (:usuario_resp, :descricao, :data_hora)");

    $bind_param = ["nome" => $nome, "usuario" => $usuario, "senha" => md5($senha), "data_hora_atualizacao" => $data_hora_atualizacao, "id" => $id];
    $bind_param1 = ["usuario_resp"=> $usuario_resp, "descricao" =>$descricao, "data_hora"=>$data_hora];

    try {            
        $stmt->execute($bind_param);
        $stmt1->execute($bind_param1);
        echo '<div class="msg-cadastro-contato msg-cadastro-sucesso">Registro alterado com sucesso!</div>';
    } catch(PDOExecption $e) {
        $conn->rollback();
        echo '<div class="msg-cadastro-contato msg-cadastro-erro">Erro ao alterar registro no banco: ' . $e->getMessage() . '</div>';
    }

}

$sql = "SELECT * FROM usuarios WHERE id =". $id;    
$result = $conn->query($sql, PDO::FETCH_ASSOC);

?>

<form method="POST">
    <?php 
        while($sql = $result->fetch()){                
    ?>


<div id="div-form">
    
    <h2>Alteração de novo usuário</h2>

    
        <div>
            <label>Nome</label>
            <input type="text" name="nome" value="<?=$sql['nome']?>" placeholder="Digite seu nome..." />
        </div>
        <div>
            <label>Usuário</label>
            <input type="text" name="usuario" value="<?=$sql['usuario']?>" placeholder="Digite seu usuário..." />
        </div>
        <div>
            <label>Senha</label>
            <input type="senha" name="senha" value="<?=$sql['senha']?>" placeholder="Digite sua senha..." />
        </div>
        <button type="submit">Alterar</button>
    </form>
    
    <?php
        }
    ?>    
<div>

<div id="btn-limpar-sessao">
    <a href="?pg=usuario/usuarios">Voltar</a>
</div>