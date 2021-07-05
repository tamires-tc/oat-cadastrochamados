<?php

$sql = "SELECT * FROM usuarios";

$result = $conn->query($sql, PDO::FETCH_ASSOC);

?>

<h2>Cadastro de usuários</h2>

<div class="menu-usuarios">
    <ul>
        <a href="?pg=usuario/cadastrar_usuario"><li>Cadastrar novo usuário</li></a>
    </ul>
</div>


<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Usuário</th>
        <th>senha</th>
        <th>Data criação</th>
        <th>Data alteração</th>
        <th>Alterar</th>
        <th>Excluir</th>
    </tr>
    <?php
        while($linha = $result->fetch()){
    ?>
        <tr>
            <?php 
                foreach($linha as $chave => $valor){
            ?>
                <td><?= $valor ?></td>
                
            <?php
                }
            ?>
            <td>
            <a href="?pg=usuario/alterar_usuario&id=<?= $linha['id'] ?>">Alterar</a>
            </td>
            <td>
            <a href="?pg=usuario/excluir_usuario&id=<?= $linha['id'] ?>">Excluir</a>
            </td>            
        </tr>
    <?php
        }
    ?>
</table>