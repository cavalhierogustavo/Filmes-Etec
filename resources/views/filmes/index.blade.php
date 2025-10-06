<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Filmes - CINEMAX</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        
        :root {
            --bg: #0b0b0b;
            --card: #141414;
            --border: rgba(255, 255, 255, 0.1 );
            --text: #ffffff;
            --muted: #a0a7af;
            --accent: #e50914;
            --shadow: rgba(0, 0, 0, 0.4);
            --success: #1f873d;
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

        
        .page-header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border);
        }
        .page-header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
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
            transition: all 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px var(--shadow);
        }
        .btn-primary {
            background-color: var(--accent);
            color: var(--text);
        }

        
        .alert-success {
            background-color: rgba(31, 135, 61, 0.2);
            border: 1px solid var(--success);
            color: #a3e9b8;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
        }

        
        .filmes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 2rem;
        }

        
        .card {
            background: var(--card);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid transparent;
            box-shadow: 0 8px 30px var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px var(--shadow);
            border-color: var(--border);
        }

        .card-image-wrapper {
            overflow: hidden;
            position: relative;
        }
        .card-image-wrapper::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, transparent 50%);
        }
        .card img {
            width: 100%;
            display: block;
            aspect-ratio: 2 / 3;
            object-fit: cover;
            background-color: #222;
            transition: transform 0.4s ease;
        }
        .card:hover img {
            transform: scale(1.05);
        }

        .card-content {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .card-content h3 {
            margin: 0;
            font-size: 1.2rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .card-content .meta {
            color: var(--muted);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        .card-content .edit-link {
            margin-top: auto;
            padding-top: 1rem;
            color: var(--accent);
            font-weight: 600;
            text-decoration: none;
            align-self: flex-start;
        }
        .card-content .edit-link:hover {
            text-decoration: underline;
        }
         .btn-secondary {
            background-color: var(--card);
            border: 1px solid var(--border);
            color: var(--text);
         }
    </style>
</head>
<body>

    <div class="container">
        <header class="page-header">
            <h1>Gerenciar Filmes</h1>
            <div class="header-actions">
                {{-- Botão para voltar ao Dashboard --}}
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Voltar ao Dashboard</a>
                
                {{-- Botão para cadastrar um novo filme --}}
                <a href="{{ route('filmes.create') }}" class="btn btn-primary">Cadastrar Novo Filme</a>
            </div>
        </header>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="filmes-grid">
            @forelse ($filmes as $filme)
                <div class="card">
                    <div class="card-image-wrapper">
                        @if ($filme->cartaz_path)
                            <img src="{{ Storage::url($filme->cartaz_path) }}" alt="Cartaz de {{ $filme->titulo }}">
                        @else
                            <img src="https://via.placeholder.com/480x720.png?text=Sem+Imagem" alt="Sem imagem">
                        @endif
                    </div>
                    <div class="card-content">
                        <h3>{{ $filme->titulo }}</h3>
                        <p class="meta">{{ $filme->ano_lancamento }} • {{ $filme->diretor }}</p>
                        {{-- Link de edição agora fica no corpo do card, mais explícito --}}
                        <a href="{{ route('filmes.edit', $filme->id ) }}" class="edit-link">Editar →</a>
                    </div>
                </div>
            @empty
                <p style="color: var(--muted); width: 100%; text-align: center; grid-column: 1 / -1; font-size: 1.2rem; padding: 4rem 0;">
                    Nenhum filme encontrado. Que tal <a href="{{ route('filmes.create') }}" style="color: var(--accent);">cadastrar o primeiro</a>?
                </p>
            @endforelse
        </div>
    </div>

</body>
</html>
