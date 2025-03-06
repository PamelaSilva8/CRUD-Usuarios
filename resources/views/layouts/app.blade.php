<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        
        html, body {
            height: 100%;
            margin: 0;
        }
        
        .navbar-custom {
            background-color:rgba(92, 107, 192, 0.74); 
        }

        .content-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .content {
            flex: 1;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 10px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <nav class="navbar navbar-dark navbar-custom">
            <a class="navbar-brand" href="{{ route('users.index') }}">CRUD Usuários</a>
        </nav>

        <div class="container mt-4 content">
            @yield('content')
        </div>

        <footer class="footer text-center">
            <div class="container">
                <p class="mb-0">© CRUD Usuários - Todos os direitos reservados.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
