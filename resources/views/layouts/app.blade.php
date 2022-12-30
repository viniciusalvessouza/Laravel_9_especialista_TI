<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Especializa TI</title>
</head>
<body>
    {{-- faco um post para ele seguir o "caminho breeze" (pq usei o breeze) de logout, pelas
     rota do arquivo auth.php
    --}}
    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button type="submit"> logout </button>
    </form>
    
    <div class="app">
        @yield('content')
    </div>
</body>
</html>