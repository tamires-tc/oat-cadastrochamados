<?php
    $sqlCategorias = "SELECT * FROM categorias";
    $resultCategorias = $conn->query($sqlCategorias, PDO::FETCH_ASSOC);
?>


<h2>Controle de Chamados</h2>

<div class="menu-usuarios">
    <ul>
        <a href="?pg=chamado/cadastro"><li>Cadastrar novo chamado</li></a>
    </ul>
</div>

<?php
    if(isset($_POST['busca'])) {
        $nome = "%".trim($_POST['busca'])."%";
        $sth = $conn->prepare('SELECT c.id, c.descricao, c.data_abertura, status.nome as status_nome, categorias.nome  FROM chamados c 
        INNER JOIN categorias ON categorias.id = c.id_categoria
        INNER JOIN status ON status.id = c.status
        where c.descricao like :nome or c.id like :nome ORDER BY c.id DESC ');
        $sth->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }else if(isset($_POST['categoria'])){
        $nome = "%".trim($_POST['categoria'])."%";
        $sth = $conn->prepare('SELECT c.id, c.descricao, c.data_abertura, status.nome as status_nome, categorias.nome  FROM chamados c 
        INNER JOIN categorias ON categorias.id = c.id_categoria
        INNER JOIN status ON status.id = c.status
        where categorias.nome like :nome ORDER BY c.id DESC');
        $sth->bindParam(':nome', $nome, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        $sql = "SELECT c.id, c.descricao, c.data_abertura, status.nome as status_nome, categorias.nome  FROM chamados c 
        INNER JOIN categorias ON categorias.id = c.id_categoria
        INNER JOIN status ON status.id = c.status";
        $result = $conn->query($sql, PDO::FETCH_ASSOC);
    }

?>

    <form method="POST">        
        <input id="busca" name="busca" type="text" placeholder="Buscar">
        <button>Buscar</button>
    </form>
    
    <form method="POST"> 
        <div>
            <select name="categoria">
                <option required value="">Busca por categoria...</option>
                <?php
                    while($linha = $resultCategorias->fetch()){
                ?>
                    <option value="<?= $linha["nome"] ?>"><?= $linha["nome"] ?></option>
                <?php 
                    } 
                ?>
            </select>
            <button>Buscar</button>
        </div>        
    </form> 

<table>
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>Data Cadastro</th>        
        <th>Status</th>
        <th>Categoria</th>
    </tr>
    <?php
        foreach($result as $linha){
    ?>
        <tr>
            <?php 
                foreach($linha as $chave => $valor){
            ?>
                <td><?= $valor ?></td>
                
            <?php
                }
            ?>        
        </tr>
    <?php
        }
    ?>
</table>