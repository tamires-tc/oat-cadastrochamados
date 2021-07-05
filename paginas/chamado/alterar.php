<?php

    $id = $_GET["id"];
    
if(!empty($_POST)){   
    $descricao = $_POST["descricao"];
    $id_categoria = $_POST["id_categoria"];
    $id_usuario = $_POST["id_usuario"];
    $status = $_POST["status"];
 
    
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

<h2>Alteração de usuário</h2>

<form method="POST">
    <?php 
        while($sql = $result->fetch()){               
    ?>

    <div id="div-form">
    
    <div>
            <label>Descrição</label>
            <input type="textarea" name="descricao" required placeholder="Digite a descrição..." />
        </div>
        <div>
            <label>Categoria</label>
            <select name="categoria">
                <option required value="">Selecione a categria...</option>
                <?php
                    while($linha = $resultCategorias->fetch()){
                ?>
                    <option value="<?= $linha["id"] ?>"><?= $linha["nome"] ?></option>
                <?php 
                    } 
                ?>
            </select>
        </div>
        <div>
            <label>Status</label>
            <select name="status">
                <option required value="">Selecione o status...</option>
                <?php
                    while($linha = $resultCategorias->fetch()){
                ?>
                    <option value="<?= $linha["id"] ?>"><?= $linha["nome"] ?></option>
                <?php 
                    } 
                ?>
            </select>
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