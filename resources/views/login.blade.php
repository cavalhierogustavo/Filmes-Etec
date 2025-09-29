<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CINEMAX — Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <header class="cabecalho-site">
    <div class="container cabecalho-conteudo">
      <div class="marca">
        <a href="#" aria-label="CINEMAX"><span class="logo">CINEMAX</span></a>
      </div>
      <nav class="navegacao-principal" aria-label="Navegação principal">
        <ul>
          <li><a href="#">Filmes</a></li>
          <li><a href="#">Cinema</a></li>
          <li><a href="#">Quem Somos</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
      </nav>
      <div class="acoes-cabecalho">
        <a href="login.html" class="botao primario">Entrar</a>
      </div>
    </div>
  </header>

  <div class="login-wrapper">
    <div class="login-card">
      <h2>Login</h2>
       @if ($errors->any())
        <div style="margin-bottom: 1rem; color: #ff7b7b; background: rgba(229, 9, 20, 0.1); padding: 10px; border-radius: 6px;">
            {{ $errors->first('email') }}
        </div>
    @endif

    {{-- MUDE O MÉTODO PARA "post" E A ACTION PARA A ROTA CORRETA --}}
    <form action="{{ route('login.do') }}" method="post">
        @csrf {{-- ADICIONE O TOKEN DE SEGURANÇA --}}
        
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
        <button type="submit">Entrar</button>
         <div class="form-footer">
          <a href="cadastros">Não Tenho Login</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>