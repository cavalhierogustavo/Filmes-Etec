<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard CINEMAX</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

    <style>
        /* --- GERAL E VARIÁVEIS --- */
        :root {
            --bg: #0b0b0b;
            --card: #141414;
            --border: rgba(255, 255, 255, 0.08 );
            --text: #ffffff;
            --muted: #8c939a; /* Tom de cinza mais suave */
            --accent: #e50914;
            --shadow: rgba(0, 0, 0, 0.2);
        }
        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            margin: 0;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* --- CABEÇALHO PRINCIPAL --- */
        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.5rem 2rem;
            background-color: var(--card);
            border-bottom: 1px solid var(--border);
        }
        .main-header .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--accent);
            text-decoration: none;
        }
        .main-header .user-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .main-header .user-info {
            color: var(--muted);
            font-size: 1.5rem;
        }
        .main-header .logout-button {
            background: none;
            border: 1px solid var(--border);
            color: var(--muted);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .main-header .logout-button:hover {
            background-color: var(--border);
            color: var(--text);
        }

        /* --- TÍTULO DA PÁGINA E AÇÕES --- */
        .page-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .page-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }
        .page-header .action-buttons {
            display: flex;
            gap: 1rem;
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px var(--shadow);
        }
        .btn-primary {
            background-color: var(--accent);
            color: var(--text);
        }
        .btn-secondary {
            background-color: var(--card);
            border: 1px solid var(--border);
            color: var(--text);
        }

        /* --- CARDS DE ESTATÍSTICAS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .stat-card {
            background-color: var(--card);
            border: 1px solid var(--border);
            padding: 1.5rem;
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .stat-card h3 {
            margin: 0 0 1rem 0;
            color: var(--muted);
            font-size: 1rem;
            font-weight: 500;
        }
        .stat-card p {
            margin: 0;
            font-size: 3rem;
            font-weight: 700;
            color: var(--text);
            line-height: 1;
        }

        /* --- GRÁFICOS --- */
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        @media (min-width: 992px) {
            .charts-grid {
                grid-template-columns: 5fr 7fr; /* Gráfico de pizza menor */
            }
        }
        .chart-container {
            background-color: var(--card);
            border: 1px solid var(--border);
            padding: 2rem;
            border-radius: 12px;
        }
        .chart-container h2 {
            margin-top: 0;
            margin-bottom: 2rem;
            text-align: center;
            font-weight: 600;
            font-size: 1.25rem;
        }
    </style>
</head>
<body>

    <header class="main-header">
        <a href="#" class="logo">CINEMAX</a>
        <div class="user-actions">
            @auth
                <span class="user-info">Olá, {{ Auth::user()->nome }}</span>
            @endauth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">Sair</button>
            </form>
        </div>
    </header>

    <main class="container">
        <div class="page-header">
            <h1>Dashboard</h1>
            <div class="action-buttons">
                <a href="{{ route('filmes.index') }}" class="btn btn-secondary">Gerenciar Filmes</a>
                <a href="{{ route('filmes.create') }}" class="btn btn-primary">Cadastrar Novo Filme</a>
            </div>
        </div>

        <section class="stats-grid">
            <div class="stat-card">
                <h3>Total de Filmes</h3>
                <p>{{ $TotalFilmes ?? '0' }}</p>
            </div>
            <div class="stat-card">
                <h3>Total de Categorias</h3>
                <p>{{ $totalCategorias ?? '0' }}</p>
            </div>
            <div class="stat-card">
                <h3>Filme Mais Recente</h3>
                <p>{{ $anoFilmeMaisRecente ?? 'N/D' }}</p>
            </div>
            <div class="stat-card">
                <h3>Filme Mais Antigo</h3>
                <p>{{ $anoFilmeMaisAntigo ?? 'N/D' }}</p>
            </div>
        </section>

        <section class="charts-grid">
            <div class="chart-container">
                <h2>Filmes por Categoria</h2>
                <div id="chart-categorias" style="width: 100%; height: 400px;"></div>
            </div>
            <div class="chart-container">
                <h2>Filmes Lançados por Ano</h2>
                <div id="chart-anos" style="width: 100%; height: 400px;"></div>
            </div>
        </section>
    </main>

<script type="text/javascript">
    // O seu código JavaScript para os gráficos continua perfeito.
    // Nenhuma alteração é necessária aqui.
    // ... (cole o seu <script> original aqui) ...
    var chartCategoriasDom = document.getElementById('chart-categorias');
    var chartCategorias = echarts.init(chartCategoriasDom);
    const filmesPorCategoria = @json($filmesPorCategoria);

    // Mudei para um gráfico de Pizza (Donut), fica mais interessante para categorias
    var optionCategorias = {
        tooltip: {
            trigger: 'item'
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            textStyle: { color: 'var(--muted)' }
        },
        series: [{
            name: 'Filmes',
            type: 'pie',
            radius: ['40%', '70%'], // Cria o efeito "donut"
            avoidLabelOverlap: false,
            label: { show: false, position: 'center' },
            emphasis: {
                label: { show: true, fontSize: 20, fontWeight: 'bold' }
            },
            labelLine: { show: false },
            data: filmesPorCategoria.map(item => ({ value: item.total_filmes, name: item.nome })),
            color: ['#b950daff','#403742ff', '#313b92ff', '#e25b1cff', '#ff00ffff', '#4e240bff', '#ff0000ff'] // Paleta de cores
        }]
    };
    chartCategorias.setOption(optionCategorias);

    var chartAnosDom = document.getElementById('chart-anos');
    var chartAnos = echarts.init(chartAnosDom);
    const filmesPorAno = @json($filmesPorAno);
    filmesPorAno.sort((a, b) => a.ano_lancamento - b.ano_lancamento);
    const anosLancamento = filmesPorAno.map(item => item.ano_lancamento);
    const totaisPorAno = filmesPorAno.map(item => item.total_filmes);

    var optionAnos = {
        tooltip: { trigger: 'axis' },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: anosLancamento,
            axisLabel: { color: 'var(--muted)' }
        },
        yAxis: {
            type: 'value',
            axisLabel: { color: 'var(--muted)' }
        },
        series: [{
            name: 'Filmes Lançados',
            data: totaisPorAno,
            type: 'line',
            smooth: true,
            itemStyle: { color: 'var(--accent)' },
            areaStyle: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    offset: 0,
                    color: 'rgba(229, 9, 20, 0.5)'
                }, {
                    offset: 1,
                    color: 'rgba(229, 9, 20, 0)'
                }])
            }
        }],
        grid: { left: '3%', right: '4%', bottom: '3%', containLabel: true }
    };
    chartAnos.setOption(optionAnos);

    window.addEventListener('resize', function() {
        chartCategorias.resize();
        chartAnos.resize();
    });
</script>

</body>
</html>
