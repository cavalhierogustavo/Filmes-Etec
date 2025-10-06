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
        <a href="/" aria-label="CINEMAX"><span class="logo">CINEMAX</span></a>
      </div>
      <nav class="navegacao-principal" aria-label="Navegação principal">
        <ul>
          <li><a href="/">Filmes</a></li>
          <li><a href="quemsomos">Quem Somos</a></li>
          <li><a href="contato">Contato</a></li>
        </ul>
      </nav>
      <div class="acoes-cabecalho">
        {{-- O botão de entrar não é necessário na própria página de login --}}
      </div>
    </div>
  </header>

  <main class="login-wrapper">
    <div class="login-card">
      <h2>Acessar Painel</h2>

      @if ($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('login.do') }}" method="post">
        @csrf
        
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required value="{{ old('email') }}">
        </div>
        
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
        </div>

        <button type="submit">Entrar</button>

        <div class="form-footer">
          <a href="{{ url('/cadastros') }}">Não tenho uma conta</a>
        </div>
      </form>
    </div>
  </main>

</body>

</html>