<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du livre</title>
    <style>
        body { margin:0; font-family: Arial; }
        nav { background:#2c3e50; color:white; padding:15px; display:flex; justify-content:space-between; }
        nav a { color:white; margin-left:15px; text-decoration:none; }
        nav a:hover { text-decoration:underline; }
        footer { background:#2c3e50; color:white; text-align:center; padding:20px; position:fixed; bottom:0; width:100%; }
        .container { max-width:800px; margin:80px auto 100px; padding:20px; }
        .btn { display:inline-block; background:#3498db; color:white; padding:10px 15px; border-radius:5px; text-decoration:none; margin:3px; }
        .btn:hover { background:#2980b9; }
    </style>
</head>
<body>

<nav>
    <div class="logo"><a href="{{ url('/') }}">Library</a></div>
    <div class="menu">
        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('books.index') }}">Livres Admin</a>
                <a href="{{ url('/logout') }}">Déconnexion</a>
            @else
                <a href="{{ route('books.index') }}">Ma bibliothèque</a>
                <a href="{{ url('/logout') }}">Déconnexion</a>
            @endif
        @else
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">Inscription</a>
        @endauth
    </div>
</nav>

<div class="container">
    <h1>{{ $book->title }}</h1>
    <p><strong>Auteur :</strong> {{ $book->author }}</p>
    <p>{{ $book->description }}</p>

    @if(auth()->user()->role === 'user')
        <a href="{{ route('books.purchase', $book->id) }}" class="btn">Acheter</a>
    @endif

    @if(auth()->user()->role === 'admin')
        <a href="{{ route('books.edit', $book->id) }}" class="btn">Modifier</a>
        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button class="btn" style="background:red;">Supprimer</button>
        </form>
    @endif
</div>

<footer>
    &copy; {{ date('Y') }} Library - Tous droits réservés
</footer>

</body>
</html>
