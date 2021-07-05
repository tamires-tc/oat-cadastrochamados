<?php


if(!empty($_POST)){
    
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $senha = $_POST["senha"];

    # Insert no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email,telefone, senha) VALUES (:nome, :email,:telefone, :senha)");

    $bind_param = ["nome" => $nome, "email" => $email,"telefone" => $telefone, "senha" => md5($senha)];

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
    <a href="?pg=login/formulario">Voltar</a>
</div>