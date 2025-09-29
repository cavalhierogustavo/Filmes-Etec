<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>CINEMAX — Cadastro</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
  <!-- Se o seu CSS estiver na pasta public/css, o link deve ser assim: -->
  <link rel="stylesheet" href="{{ asset('css/cadastro.css') }}">
  <style>
    /* Estilos para as mensagens de feedback */
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
        <a href="#" aria-label="CINEMAX"><span class="logo">CINEMAX</span></a>
      </div>
      <nav class="navegacao-principal" aria-label="Navegação principal">
        <ul>
          <li><a href="/">Filmes</a></li>
          <li><a href="#">Cinema</a></li>
          <li><a href="quemsomos">Quem Somos</a></li>
          <li><a href="contato">Contato</a></li>
        </ul>
      </nav>
      <div class="acoes-cabecalho">
        <a href="login" class="botao primario">Entrar</a>
      </div>
    </div>
  </header>

  <div class="cadastro-wrapper">
    <div class="cadastro-card">
      <h2>Cadastro Para Admin</h2>
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


      <div id="feedback" class="feedback-message" style="display: none;"></div>

      
      <form id="cadastroForm" action="{{route('cadastro.store')}}" method="post">
       @csrf
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>

        <label for="email">E-mail</label>
        <input type="email" id="email" name="email" placeholder="Digite seu e-mail" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>

        <label for="telefone">Telefone</label>
        <input type="tel" id="telefone" name="telefone" placeholder="Digite seu telefone" required>

        <label for="cpf">CPF</label>

        <input type="text" id="cpf" name="cpf" placeholder="Digite seu CPF" required>

        <button type="submit">Cadastrar</button>
      </form>
    </div>
  </div>

<script src="js/cadastro.js"></script>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<script>
    // Seleciona o formulário e a div de feedback
    const form = document.getElementById('cadastroForm');
    const feedbackDiv = document.getElementById('feedback');

    // Adiciona um "ouvinte" para o evento de envio do formulário
    form.addEventListener('submit', function (event) {
        // 1. Previne o envio padrão (que recarrega a página)
        event.preventDefault();

        // Limpa mensagens antigas
        feedbackDiv.style.display = 'none';
        feedbackDiv.innerHTML = '';
        feedbackDiv.className = 'feedback-message';

        // 2. Pega os dados do formulário
        const formData = new FormData(form);

        // 3. Envia os dados usando Fetch API (AJAX)
        fetch('{{ route('cadastro.store') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json', // Informa que esperamos JSON
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
