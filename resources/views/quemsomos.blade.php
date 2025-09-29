<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quem Somos</title>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
<style>
:root{
  --bg:#0b0b0b;
  --card:#141414;
  --muted:#bfc4c9;
  --accent:#e50914;
  --glass: rgba(255,255,255,0.04);
  --max-width:1200px;
  font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
  color-scheme: dark;
}
body{
  margin:0;
  background: linear-gradient(180deg,#070707 0%, #0b0b0b 100%);
  color:#fff;
}
.container{
  width:90%;
  max-width:var(--max-width);
  margin:0 auto;
}
.cabecalho-site{
  position:sticky;
  top:0;
  z-index:50;
  backdrop-filter: blur(6px);
  background: linear-gradient(180deg, rgba(57,57,57,0.85), rgba(11,11,11,0.6));
}
.cabecalho-conteudo{
  display:flex;
  align-items:center;
  gap:200px;
  padding:14px 0;
}
.marca .logo{
  font-weight:1000;
  color:var(--accent);
  font-size:25px;
}
.navegacao-principal ul{
  display:flex;
  gap:25px;
  list-style:none;
  padding:0;
  margin:0;
}
.navegacao-principal a{
  color:#ddd;
  text-decoration:none;
  font-weight:500;
  padding:6px 8px;
  border-radius:4px;
}
.navegacao-principal a:hover,
.navegacao-principal a.ativo{
  color:#fff;
  background:rgba(255,255,255,0.04);
}
.acoes-cabecalho{
  margin-left:auto;
  display:flex;
  align-items:center;
  gap:10px;
}
.acoes-cabecalho input[type="search"]{
  background:transparent;
  border:1px solid rgba(255,255,255,0.06);
  padding:8px 10px;
  border-radius:6px;
  color: #fff;
  min-width:160px;
}
.botao{
  background:transparent;
  border:1px solid rgba(255,255,255,0.08);
  color: #fff;
  padding:8px 12px;
  border-radius:6px;
  cursor:pointer;
  font-weight:600;
}
.botao.pequeno{padding:6px 10px;font-size:14px}
h1{text-align:center;margin-top:40px;margin-bottom:20px;}
h3{max-width:800px;margin:0 auto 40px auto;text-align:center;font-weight:400;color:var(--muted);}

/* Cards da equipe */
.equipe{
  display:grid;
  grid-template-columns: repeat(auto-fit,minmax(200px,1fr));
  gap:20px;
  margin-bottom:50px;
}
.card{
  background: var(--card);
  border-radius:12px;
  box-shadow:0 6px 20px rgba(0,0,0,0.5);
  overflow:hidden;
  text-align:center;
  padding-bottom:20px;
}
.card img{
  width:100%;
  height:250px;
  object-fit:cover;
  border-bottom:1px solid rgba(255,255,255,0.08);
}
.card h4{
  margin:15px 0 5px 0;
}
.card p{
  color:var(--muted);
  font-size:14px;
  margin:0 15px;
}
</style>
</head>
<body>

<header class="cabecalho-site">
  <div class="container cabecalho-conteudo">
    <div class="marca"><a href="#"><span class="logo">CINEMAX</span></a></div>
    <nav class="navegacao-principal">
      <ul>
        <li><a href="#">Filmes</a></li>
        <li><a href="#">Cinema</a></li>
        <li><a href="#">Quem Somos</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
    </nav>
    <div class="acoes-cabecalho">
      <input type="search" placeholder="Pesquisar">
      <button class="botao pequeno">Entrar</button>
      <a href="login"><button> Entre</button></a>
    </div>
  </div>
</header>

<h1>Quem Somos – Cinemax</h1>
<h3><i>"Através da Cinemax você desfruta dos melhores lançamentos." Somos apaixonados por cinema e dedicados a levar até você as novidades mais quentes da telona.</i></h3>

<div class="container equipe">
  <div class="card">
    <img src="img/adrielMendingo.jpeg" alt="Larissa">
        <h4>João</h4>
    <p>Editor de Filmes</p>
  </div>
  <div class="card">
    <img src="img/gustavo.jpeg" alt="João">
    <h4>João</h4>
    <p>Editor de Filmes</p>
  </div>
  <div class="card">
    <img src="img/larrisa.jpeg" alt="Maria">
    <h4>Maria</h4>
    <p>Design Gráfico</p>
  </div>
</div>

</body>
</html>