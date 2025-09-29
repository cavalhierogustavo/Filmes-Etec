<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>CINEMAX — Home</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/home.css">
</head>
<body>
  <header class="cabecalho-site">
    <div class="container cabecalho-conteudo">
      <div class="marca">
        <a href="#" aria-label="AdrielFlix">
          <span class="logo">CINEMAX</span>
        </a>
      </div>

      <nav class="navegacao-principal" aria-label="Navegação principal">
        <ul>
          <li><a href="#">Filmes</a></li>
          <li><a href="#">Cinema</a></li>
          <li><a href="quemsomos">Quem Somos</a></li>
          <li><a href="#">Contato</a></li>
        </ul>
      </nav>

      <div class="acoes-cabecalho">
        <input type="search" placeholder="Pesquisar" aria-label="Pesquisar" />
        <a href="login"><button class="botao pequeno">Entrar</button></a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">Sair</button>
        </form>
      </div>
    
    </div>
  </header>

  <section class="destaque">
    <div class="sobreposicao-destaque"></div>
    <picture class="midia-destaque">
      <img src="img/superman.jpg">
    </picture>

    <div class="container conteudo-destaque">
      <h1>Através da Cinemax você desfruta dos melhores lançamentos.</h1>
      <p class="subtitulo">Prepare a pipoca, a sessão já vai começar.</p>

      <div class="acoes-destaque">
        <button class="botao grande primario">Ingressos</button>
        <a href="http://"><button class="botao grande fantasma">→</button></a>
      </div>
    </div>
  </section>

 <main class="container principal">
    <section class="linha">
        <div class="cabecalho-linha">
            <h2>Filmes em Cartaz</h2>
            <a href="#" class="ver-tudo">Ver tudo →</a>
        </div>

        <div class="cartoes" aria-label="Populares da semana">
            
            @forelse ($filmes as $filme)
                <article class="cartao">
                    
                    @if ($filme->cartaz_path)
                        <img src="{{ Storage::url($filme->cartaz_path) }}" alt="Cartaz do filme {{ $filme->titulo }}">
                    @else
                        <img src="https://via.placeholder.com/300x450.png?text=Sem+Imagem" alt="Sem imagem">
                    @endif

                    <div class="corpo-cartao">
                        <h3>{{ $filme->titulo }}</h3>
                        
                        <p class="meta">
                            @if ($filme->categorias->isNotEmpty())
                                {{ $filme->categorias->first()->nome }}
                            @endif
                            • {{ $filme->ano_lancamento }}
                        </p>
                    </div>
                </article>
            @empty
                <p style="color: var(--muted); width: 100%; text-align: center;">
                    Ainda não há filmes cadastrados.
                </p>
            @endforelse
            </div>
    </section>
    
    </main>

  <footer class="rodape-site">
    <div class="container conteudo-rodape">
      <div>
        <p><strong>AdrielFlix</strong> © <span id="ano"></span></p>
        <p class="pequeno">Telefone: (xx) xxxx-xxxx • Suporte: suporte@adrielflix.com</p>
      </div>

      <div class="links-rodape">
        <a href="#">Termos</a>
        <a href="#">Privacidade</a>
        <a href="#">Ajuda</a>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById('ano').textContent = new Date().getFullYear();
    const carrossel = document.querySelector('.carrossel');
    if (carrossel) {
      let estaPressionado = false;
      let inicioX, scrollEsquerda;
      const faixa = carrossel.querySelector('.faixa-carrossel');

      carrossel.addEventListener('mousedown', (e) => {
        estaPressionado = true;
        carrossel.classList.add('arrastando');
        inicioX = e.pageX - carrossel.offsetLeft;
        scrollEsquerda = faixa.scrollLeft;
      });
      carrossel.addEventListener('mouseleave', () => { estaPressionado = false; carrossel.classList.remove('arrastando'); });
      carrossel.addEventListener('mouseup', () => { estaPressionado = false; carrossel.classList.remove('arrastando'); });
      carrossel.addEventListener('mousemove', (e) => {
        if(!estaPressionado) return;
        e.preventDefault();
        const x = e.pageX - carrossel.offsetLeft;
        const deslocamento = (x - inicioX) * 1.5;
        faixa.scrollLeft = scrollEsquerda - deslocamento;
      });
    }
  </script>
</body>
</html>