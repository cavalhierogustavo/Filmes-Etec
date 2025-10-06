<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quem Somos</title>
<link rel="stylesheet" href="./css/quemsomos.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
</head>
<body>

<header class="cabecalho-site">
  <div class="container cabecalho-conteudo">
    <div class="marca">
      <a href="/">
        <span class="logo">CINEMAX</span>
      </a>
    </div>
    <nav class="navegacao-principal">
      <ul>
        <li><a href="/">Filmes</a></li>
        <li><a href="#" class="ativo">Quem Somos</a></li>
        <li><a href="contato">Contato</a></li>
      </ul>
    </nav>
    <div class="acoes-cabecalho">
      <input type="search" placeholder="Pesquisar">
      <a href="{{ route('login') }}"><button class="botao">Entrar</button></a>
    </div>
  </div>
</header>

<main>
    <section class="hero-quemsomos">
        <div class="container">
            <h1>Nossa Paixão, Sua Tela</h1>
            <p class="subtitulo">
                "Através da Cinemax você desfruta dos melhores lançamentos." Somos um time de cinéfilos dedicados a curar e apresentar as novidades mais quentes da telona, conectando histórias e espectadores.
            </p>
        </div>
    </section>

    <section class="section-equipe">
        <div class="container">
            <h2>Conheça o Time</h2>
            <div class="equipe-grid">
                <div class="card-membro">
                    <div class="imagem-wrapper">
                        <img src="{{ asset('img/adrielMendingo.jpeg') }}" alt="Foto de Adriel">
                    </div>
                    <div class="info">
                        <h4>Adriel</h4>
                        <p>faxineiro</p>
                    </div>
                </div>
                <div class="card-membro">
                    <div class="imagem-wrapper">
                        <img src="{{ asset('img/gustavo.jpeg') }}" alt="Foto de Gustavo">
                    </div>
                    <div class="info">
                        <h4>Gustavo</h4>
                        <p>segurança</p>
                    </div>
                </div>
                <div class="card-membro">
                    <div class="imagem-wrapper">
                        <img src="{{ asset('img/larrisa.jpeg') }}" alt="Foto de Larissa">
                    </div>
                    <div class="info">
                        <h4>Larissa</h4>
                        <p>Front end</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

</body>
