<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CINEMAX — Cadastro</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
  <style>
    
    .feedback-message {
      padding: 1rem;
      border-radius: 8px;
      margin-bottom: 1rem;
      text-align: center;
      font-weight: 600;
    }
    .success {
      background-color: #d4edda;
      color: #155724;
    }
    .error {
      background-color: #f8d7da;
      color: #721c24;
    }
    .error ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }
  </style>
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
          <li><a href="#">Cinema</a></li>
          <li><a href="{{ url('/quemsomos') }}">Quem Somos</a></li>
          <li><a href="{{ url('/contato') }}">Contato</a></li>
        </ul>
      </nav>
      <div class="acoes-cabecalho">
        <a href="{{ route('login') }}" class="botao primario">Entrar</a>
      </div>
    </div>
  </header>

  <main class="cadastro-wrapper">
    <div class="cadastro-card">
      <h2>Crie sua Conta de Admin</h2>

      {{-- Mensagens de feedback do Laravel (Blade) --}}
      @if (session('success'))
        <div class="feedback-message success">
            {{ session('success') }}
        </div>
      @endif
      @if ($errors->any())
        <div class="feedback-message error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      {{-- Div para feedback do JavaScript (AJAX) --}}
      <div id="feedback" style="display: none;"></div>

      <form id="cadastroForm" action="{{ route('cadastro.store') }}" method="post">
        @csrf
        <input type="hidden" name="tipo" value="admin">
        <input type="hidden" name="deleted" value="0">

        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
        </div>

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>
        </div>

        <div class="form-group">
          <label for="senha">Senha</label>
          <input type="password" id="senha" name="senha" placeholder="Crie uma senha forte" required>
        </div>

        <div class="form-group">
          <label for="telefone">Telefone</label>
          <input type="tel" id="telefone" name="telefone" placeholder="(xx) xxxxx-xxxx" required>
        </div>

        <div class="form-group">
          <label for="cpf">CPF</label>
          <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
        </div>

        <button type="submit">Cadastrar</button>
      </form>
    </div>
  </main>

<script>
    
    const form = document.getElementById('cadastroForm');
    const feedbackDiv = document.getElementById('feedback');

    
    form.addEventListener('submit', function (event) {
        
        event.preventDefault();

        
        feedbackDiv.style.display = 'none';
        feedbackDiv.innerHTML = '';
        feedbackDiv.className = 'feedback-message';

        const formData = new FormData(form);


        fetch('{{ route('cadastro.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {

            if (data.message && !data.errors) {

                feedbackDiv.classList.add('success');
                feedbackDiv.textContent = data.message;
                form.reset();
                setTimeout(function() {
                window.location.href = "login";
            }, 3000);
            } else {

                feedbackDiv.classList.add('error');
                let errorList = '<ul>';
                for (const key in data.errors) {
                    data.errors[key].forEach(error => {
                        errorList += `<li>${error}</li>`;
                    });
                }
                errorList += '</ul>';
                feedbackDiv.innerHTML = errorList;
            }
            feedbackDiv.style.display = 'block'; // Mostra a div de feedback
        })
        .catch(error => {
            // Erro de rede ou outro problema
            feedbackDiv.classList.add('error');
            feedbackDiv.textContent = 'Ocorreu um erro inesperado. Tente novamente.';
            feedbackDiv.style.display = 'block';
            console.error('Erro:', error);
        });
    });
</script>
</body>
</html>
