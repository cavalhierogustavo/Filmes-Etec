<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Filmes</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

    <style>
        :root {
            --bg: #0b0b0b;
            --card: #141414;
            --border: rgba(255, 255, 255, 0.08);
            --text: #ffffff;
            --muted: #bfc4c9;
            --accent: #e50914;
        }
        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 2rem;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        h1 {
            color: var(--accent);
            text-align: center;
            margin-bottom: 2rem;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        .stat-card {
            background-color: var(--card);
            border: 1px solid var(--border);
            padding: 1.5rem;
            border-radius: 12px;
            text-align: center;
        }
        .stat-card h3 {
            margin: 0 0 0.5rem 0;
            color: var(--muted);
            font-size: 1rem;
            font-weight: 500;
        }
        .stat-card p {
            margin: 0;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--text);
        }
        .charts-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
        @media (min-width: 992px) {
            .charts-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        .chart-container {
            background-color: var(--card);
            border: 1px solid var(--border);
            padding: 1.5rem;
            border-radius: 12px;
        }
        .chart-container h2 {
            margin-top: 0;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <h1>Dashboard CINEMAX</h1>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Filme Mais Recente</h3>
                <p>{{ $anoFilmeMaisRecente ?? 'N/D' }}</p>
            </div>
            <div class="stat-card">
                <h3>Filme Mais Antigo</h3>
                <p>{{ $anoFilmeMaisAntigo ?? 'N/D' }}</p>
            </div>
        </div>

        <div class="charts-grid">
            <div class="chart-container">
                <h2>Filmes por Categoria</h2>
                <div id="chart-categorias" style="width: 100%; height: 400px;"></div>
            </div>

            <div class="chart-container">
                <h2>Filmes Lançados por Ano</h2>
                <div id="chart-anos" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    // --- GRÁFICO 1: FILMES POR CATEGORIA (BARRAS) ---

    // 4. Pega o elemento HTML onde o gráfico será desenhado
    var chartCategoriasDom = document.getElementById('chart-categorias');
    var chartCategorias = echarts.init(chartCategoriasDom);

    // 5. Converte os dados do PHP (Laravel) para JSON, que o JavaScript entende
    const filmesPorCategoria = @json($filmesPorCategoria);

    // 6. Prepara os dados para o formato que o ECharts precisa (arrays separados para nomes e valores)
    const nomesCategorias = filmesPorCategoria.map(item => item.nome);
    const totaisCategorias = filmesPorCategoria.map(item => item.total_filmes);

    // 7. Define as opções de configuração do gráfico
    var optionCategorias = {
        tooltip: {
            trigger: 'axis',
            axisPointer: { type: 'shadow' }
        },
        xAxis: {
            type: 'category',
            data: nomesCategorias,
            axisLabel: { color: 'var(--muted)' }
        },
        yAxis: {
            type: 'value',
            axisLabel: { color: 'var(--muted)' }
        },
        series: [{
            name: 'Total de Filmes',
            data: totaisCategorias,
            type: 'bar',
            itemStyle: {
                color: 'var(--accent)'
            }
        }],
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        }
    };

    // 8. Aplica as opções e desenha o gráfico
    chartCategorias.setOption(optionCategorias);


    // --- GRÁFICO 2: FILMES LANÇADOS POR ANO (LINHA/ÁREA) ---
    
    var chartAnosDom = document.getElementById('chart-anos');
    var chartAnos = echarts.init(chartAnosDom);

    const filmesPorAno = @json($filmesPorAno);

    // Prepara os dados: ordena por ano para o gráfico de linha fazer sentido
    filmesPorAno.sort((a, b) => a.ano_lancamento - b.ano_lancamento);
    
    const anosLancamento = filmesPorAno.map(item => item.ano_lancamento);
    const totaisPorAno = filmesPorAno.map(item => item.total_filmes);

    var optionAnos = {
        tooltip: {
            trigger: 'axis'
        },
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
            smooth: true, // Deixa a linha mais suave
            itemStyle: {
                color: 'var(--accent)'
            },
            areaStyle: { // Preenche a área abaixo da linha
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    offset: 0,
                    color: 'rgba(229, 9, 20, 0.5)'
                }, {
                    offset: 1,
                    color: 'rgba(229, 9, 20, 0)'
                }])
            }
        }],
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        }
    };

    chartAnos.setOption(optionAnos);

    // Garante que os gráficos se redimensionem junto com a janela do navegador
    window.addEventListener('resize', function() {
        chartCategorias.resize();
        chartAnos.resize();
    });

</script>

</body>
</html>