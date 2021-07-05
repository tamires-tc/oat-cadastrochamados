<?php


if(!empty($_POST)){
    
    $descricao = $_POST["descricao"];
    $id_categoria = $_POST["categoria"];    
    $id_usuario = $_SESSION["id"];
    $status = 1;
    $data_abertura = date('Y-m-d H:i:s');    


    # Insert no banco de dados
    $stmt = $conn->prepare("INSERT INTO chamados (descricao, id_categoria,id_usuario, status, data_abertura) VALUES (:descricao, :id_categoria,:id_usuario, :status, :data_abertura)");

    $bind_param = ["descricao" => $descricao, "id_categoria" => $id_categoria,"status" => $status, "data_abertura"=> $data_abertura,"id_usuario" => $id_usuario];

    try {
        $conn->beginTransaction();
        $stmt->execute($bind_param);
        echo '<div class="msg-cadastro-contato msg-cadastro-sucesso">Registro ' . $conn->lastInsertId() . ' inserido no banco!</div>';
        $conn->commit();
    } catch(PDOExecption $e) {
        $conn->rollback();
        echo '<div class="msg-cadastro-contato msg-cadastro-erro">Erro ao inserir registro no banco: ' . $e->getMessage() . '</div>';
    }

}

?>

<div id="btn-limpar-sessao">
    <a href="?pg=chamado/chamados">Voltar</a>
</div>