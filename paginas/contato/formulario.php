<?php

    $sqlCidades = "SELECT c.id, c.nome, e.sigla AS sigla_estado FROM cidades c INNER JOIN estados e ON e.id = c.estado_id";
    $resultCidades = $conn->query($sqlCidades, PDO::FETCH_ASSOC);

?>

<div id="div-form">
    
    <h1>Formulário de Contato</h1>

    <form method="POST" action="?pg=contato/processar_formulario">
        <div>
            <label>Nome</label>
            <input type="text" name="nome" placeholder="Digite seu nome..." />
        </div>
        <div>
            <label>Telefone</label>
            <input type="text" name="telefone" placeholder="Digite seu telefone..." />
        </div>
        <div>
            <label>E-mail</label>
            <input type="email" name="email" placeholder="Digite seu email..." />
        </div>
        <div>
            <label>Cidade</label>
            <select name="cidade">
                <option value="">Selecione a cidade...</option>
                <?php
                    while($linha = $resultCidades->fetch()){
                ?>
                    <option value="<?= $linha["id"] ?>"><?= $linha["nome"] ?> (<?= $linha["sigla_estado"] ?>)</option>
                <?php 
                    } 
                ?>
            </select>
        </div>
        <div>
            <label>Mensagem</label>
            <textarea name="mensagem" placeholder="Digite a mensagem..."></textarea>
        </div>
        <button type="submit">Enviar</button>
    </form>
    
<div>