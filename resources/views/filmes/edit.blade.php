<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editando: {{ $filme->titulo }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        
        :root {
            --bg: #0b0b0b;
            --card: #141414;
            --border: rgba(255, 255, 255, 0.1 );
            --text: #ffffff;
            --muted: #a0a7af;
            --accent: #e50914;
            --danger: #b20710;
            --success: #1f873d;
            --shadow: rgba(0, 0, 0, 0.3);
        }
        body {
            background-color: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        
        .form-container {
            background-color: var(--card);
            border: 1px solid var(--border);
            padding: 2.5rem;
            border-radius: 16px;
            width: 100%;
            max-width: 700px;
            box-shadow: 0 10px 40px var(--shadow);
        }

        
        .form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .form-header h1 {
            margin: 0;
            font-size: 1.75rem;
            font-weight: 700;
        }
        .form-header p {
            margin: 0.5rem 0 0 0;
            color: var(--muted);
        }
        .form-header a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }
        .form-header a:hover {
            text-decoration: underline;
        }

        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .full-width {
            grid-column: 1 / -1;
        }

        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--muted);
            font-size: 0.9rem;
        }
        input, textarea, select {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            background-color: #0f0f0f;
            color: var(--text);
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.2s ease;
        }
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 10px rgba(229, 9, 20, 0.3);
        }
        textarea {
            resize: vertical;
            min-height: 120px;
        }
        select[multiple] {
            height: 180px;
        }
        small {
            color: var(--muted);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            display: block;
        }

        
        .file-upload-group {
            display: flex;
            gap: 1.5rem;
            align-items: flex-end;
        }
        .cartaz-atual img {
            width: 100px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--border);
        }
        .file-input-wrapper {
            flex-grow: 1;
        }

        
        .form-actions {
            margin-top: 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }
        .btn {
            display: inline-block;
            padding: 0.8rem 1.8rem;
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
        }
        .btn-primary {
            background-color: var(--accent);
            color: var(--text);
            box-shadow: 0 4px 15px rgba(229, 9, 20, 0.2);
        }
        .btn-danger {
            background: none;
            color: var(--muted);
            border: 1px solid var(--border);
        }
        .btn-danger:hover {
            background-color: var(--danger);
            border-color: var(--danger);
            color: var(--text);
        }

        
        .error-box {
            background-color: rgba(178, 7, 16, 0.2);
            border: 1px solid var(--danger);
            color: #f8d7da;
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 8px;
        }
        .error-box ul {
            margin: 0;
            padding-left: 1.2rem;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h1>Editando Filme</h1>
            <p>
                Modificando os detalhes de <strong>{{ $filme->titulo }}</strong>.
                <a href="{{ route('filmes.index') }}">Voltar para a lista</a>
            </p>
        </div>

        @if ($errors->any())
            <div class="error-box">
                <strong>Opa! Algo deu errado:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('filmes.update', $filme->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group full-width">
                <label for="titulo">Título do Filme</label>
                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $filme->titulo) }}" required>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="ano_lancamento">Ano de Lançamento</label>
                    <input type="number" name="ano_lancamento" id="ano_lancamento" value="{{ old('ano_lancamento', $filme->ano_lancamento) }}" required>
                </div>
                <div class="form-group">
                    <label for="diretor">Diretor</label>
                    <input type="text" name="diretor" id="diretor" value="{{ old('diretor', $filme->diretor) }}" required>
                </div>
            </div>

            <div class="form-group full-width">
                <label for="sinopse">Sinopse</label>
                <textarea name="sinopse" id="sinopse" required>{{ old('sinopse', $filme->sinopse) }}</textarea>
            </div>

            <div class="form-group full-width">
                <label for="categorias">Categorias</label>
                <select name="categorias[]" id="categorias" multiple required>
                    @php
                        $categoriasDoFilme = old('categorias', $filme->categorias->pluck('id')->toArray());
                    @endphp
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ in_array($categoria->id, $categoriasDoFilme) ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
                <small>Segure Ctrl (ou Cmd no Mac) para selecionar mais de uma.</small>
            </div>

            <div class="form-group full-width file-upload-group">
                <div class="cartaz-atual">
                    <label>Cartaz Atual</label>
                    <img src="{{ Storage::url($filme->cartaz_path) }}" alt="Cartaz de {{ $filme->titulo }}">
                </div>
                <div class="file-input-wrapper">
                    <label for="cartaz">Trocar Cartaz (opcional)</label>
                    <input type="file" name="cartaz" id="cartaz">
                </div>
            </div>

            <div class="form-actions">
                {{-- O formulário de deletar foi transformado em um único botão --}}
                <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form').submit();">Deletar Filme</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>

        {{-- Formulário de exclusão invisível, acionado pelo botão "Deletar" --}}
        <form id="delete-form" action="{{ route('filmes.destroy', $filme->id) }}" method="POST" style="display: none;" onsubmit="return confirm('Tem certeza que deseja deletar este filme? Esta ação não pode ser desfeita.');">
            @csrf
            @method('DELETE')
        </form>
    </div>

</body>
</html>
