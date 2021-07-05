<div id="div-form">
    
    <h2>Cadastro de novo usuário</h2>

    <form method="POST" action="?pg=usuario/processar_usuario">
        <div>
            <label>Nome</label>
            <input type="text" name="nome" required placeholder="Digite seu nome..." />
        </div>
        <div>
            <label>Email</label>
            <input type="text" name="email" required placeholder="Digite seu email..." />
        </div>
        <div>
            <label>Telefone</label>
            <input type="text" name="telefone" required placeholder="Digite seu email..." />
        </div>        
        <div>
            <label>Senha</label>
            <input type="senha" name="senha" required placeholder="Digite sua senha..." />
        </div>
        <button type="submit">Cadastrar</button>
    </form>
    
<div>