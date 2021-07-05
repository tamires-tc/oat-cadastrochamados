<?php

    $sqlCategorias = "SELECT * FROM categorias";
    $resultCategorias = $conn->query($sqlCategorias, PDO::FETCH_ASSOC);

?>
<div id="div-form">
    
    <h2>Cadastro de chamado</h2>

    <form method="POST" action="?pg=chamado/processar">
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
        <button type="submit">Cadastrar</button>
    </form>
    
<div>