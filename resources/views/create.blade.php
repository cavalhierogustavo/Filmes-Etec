<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CINEMAX — Cadastrar Novo Filme</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        /* O seu CSS continua o mesmo, sem alterações */
        :root {
            --bg: #0b0b0b; --card: #141414; --border: rgba(255, 255, 255, 0.08);
            --text: #ffffff; --muted: #bfc4c9; --accent: #e50914; --success: #155724;
            --success-bg: #d4edda;
        }
        body {
            background-color: var(--bg); color: var(--text); font-family: 'Inter', sans-serif;
            margin: 0; padding: 2rem;
        }
        .form-wrapper { display: flex; justify-content: center; align-items: center; padding: 2rem 0; }
        .form-card {
            background: var(--card); padding: 40px; border-radius: 12px; border: 1px solid var(--border);
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); width: 100%; max-width: 600px;
        }
        .form-card h1 { text-align: center; margin-top: 0; margin-bottom: 30px; font-weight: 800; color: var(--text); }
        .form-card label { display: block; margin-bottom: 6px; font-weight: 500; color: var(--muted); }
        .form-card input, .form-card textarea, .form-card select {
            width: 100%; padding: 12px; margin-bottom: 20px; border-radius: 6px;
            border: 1px solid var(--border); background: rgba(255,255,255,0.02);
            color: var(--text); font-size: 16px; font-family: 'Inter', sans-serif;
        }
        .form-card select[multiple] { height: 120px; padding: 10px; }
        .form-card textarea { resize: vertical; min-height: 100px; }
        .form-card input[type="file"] { padding: 8px; background-color: #222; }
        .form-card button {
            width: 100%; padding: 12px; border: none; border-radius: 6px; background: var(--accent);
            color: #fff; font-weight: 600; cursor: pointer; font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .alert { padding: 1rem; margin-bottom: 1rem; border-radius: 8px; text-align: center; }
        .alert-success { background-color: var(--success-bg); color: var(--success); font-weight: 600; }
        .alert-danger { background-color: #f8d7da; color: #721c24; list-style-position: inside; text-align: left; }
    </style>
</head>
<body>

<div class="form-wrapper">
    <div class="form-card">
        <h1>Cadastrar Novo Filme</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Opa!</strong> Algo deu errado:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('filmes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="titulo">Título do Filme</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
            </div>

            <div>
                <label for="ano_lancamento">Ano de Lançamento</label>
                <input type="number" id="ano_lancamento" name="ano_lancamento" value="{{ old('ano_lancamento') }}" required>
            </div>

            <div>
                <label for="diretor">Diretor</label>
                <input type="text" id="diretor" name="diretor" value="{{ old('diretor') }}" required>
            </div>

            <div>
                <label for="sinopse">Sinopse</label>
                <textarea id="sinopse" name="sinopse">{{ old('sinopse') }}</textarea>
            </div>
            
            <div>
                <label for="categorias">Categorias</label>
                <small style="color: var(--muted); display: block; margin-bottom: 8px;">
                    Segure Ctrl (ou Cmd no Mac) para selecionar mais de uma.
                </small>
                <select name="categorias[]" id="categorias" multiple required>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" 
                            {{ in_array($categoria->id, old('categorias', [])) ? 'selected' : '' }}>
                            {{ $categoria->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="cartaz">Cartaz do Filme</label>
                <input type="file" id="cartaz" name="cartaz" required>
            </div>

            <button type="submit">Cadastrar Filme</button>
        </form>
    </div>
</div>

</body>
</html>