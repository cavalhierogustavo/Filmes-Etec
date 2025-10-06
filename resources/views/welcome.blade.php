<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CINEMAX — Home</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  {{-- Use o helper asset para garantir que o caminho para o CSS esteja sempre correto --}}
  <link rel="stylesheet" href="{{ asset('css/home.css' ) }}">
</head>
<body>
  <header class="cabecalho-site">
    <div class="container cabecalho-conteudo">
      <a href="/" class="marca" aria-label="CINEMAX">
        <span class="logo">CINEMAX</span>
      </a>

      <nav class="navegacao-principal" aria-label="Navegação principal">
        <ul>
          <li><a href="#" class="ativo">Filmes</a></li>
          <li><a href="#">Cinema</a></li>
          <li><a href="{{ url('/quemsomos') }}">Quem Somos</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
      </nav>

      <div class="acoes-cabecalho">
        <input type="search" placeholder="Pesquisar" aria-label="Pesquisar" />
        @guest
            <a href="{{ route('login') }}"><button class="botao primario">Entrar</button></a>
        @endguest
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="botao">Sair</button>
            </form>
        @endauth
      </div>
    </div>
  </header>

  <section class="destaque">
    <div class="sobreposicao-destaque"></div>
    <picture class="midia-destaque">
      {{-- Adicione uma imagem de fallback ou use a do primeiro filme, se existir --}}
      <img src="{{ asset('img/adrielMendingo.jpeg') }}" alt="Cena de filme em destaque">
    </picture>

    <div class="container conteudo-destaque">
      <h1>Através da Cinemax você desfruta dos melhores lançamentos.</h1>
      <p class="subtitulo">Prepare a pipoca, a sessão já vai começar.</p>

      <div class="acoes-destaque">
        <button class="botao primario">Ver Ingressos</button>
        <button class="botao">Assistir Trailer →</button>
      </div>
    </div>
  </section>

 <main class="container principal">
    <section class="linha">
        <div class="cabecalho-linha">
            <h2>Filmes em Cartaz</h2>
            @auth
                <a href="{{ route('filmes.index') }}" class="ver-tudo">Gerenciar filmes →</a>
            @endauth
        </div>

        <div class="cartoes" aria-label="Filmes populares">
            @forelse ($filmes as $filme)
                {{-- O card inteiro agora é um link para a página de detalhes (se houver) --}}
                <a href="#" class="cartao">
                    <div class="cartao-imagem-wrapper">
                        @if ($filme->cartaz_path)
                            <img src="{{ Storage::url($filme->cartaz_path) }}" alt="Cartaz do filme {{ $filme->titulo }}">
                        @else
                            <img src="https://via.placeholder.com/440x660.png?text=Sem+Imagem" alt="Sem imagem">
                        @endif
                    </div>
                    <div class="corpo-cartao">
                        <h3>{{ $filme->titulo }}</h3>
                        <p class="meta">
                            @if ($filme->categorias->isNotEmpty( ))
                                {{ $filme->categorias->first()->nome }}
                            @endif
                            • {{ $filme->ano_lancamento }}
                        </p>
                    </div>
                </a>
            @empty
                <p style="color: var(--muted); width: 100%; text-align: center; grid-column: 1 / -1;">
                    Ainda não há filmes cadastrados.
                </p>
            @endforelse
        </div>
    </section>
 </main>

  <footer class="rodape-site">
    <div class="container conteudo-rodape">
      <div>
        <p><strong>CINEMAX</strong> &copy; <span id="ano"></span>. Todos os direitos reservados.</p>
        <p class="pequeno">Telefone: (11) 97646-9961 • Suporte: suporte@cinemax.com</p>
      </div>
      <div class="links-rodape">
        <a href="#">Termos de Uso</a>
        <a href="#">Privacidade</a>
        <a href="#">Ajuda</a>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById('ano').textContent = new Date().getFullYear();
  </script>
</body>
</html>
