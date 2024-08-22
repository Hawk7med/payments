<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Zones')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            margin-bottom: 60px; /* Reserve space for footer */
        }
        .navbar {
            margin-bottom: 20px;
            background: linear-gradient(90deg, rgba(0,123,255,1) 0%, rgba(0,255,255,1) 100%);
            background-size: 200% 200%;
            animation: gradientAnimation 5s ease infinite;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }
        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
        }
        .navbar-nav .nav-link:hover {
            color: #ddd !important;
        }
        .navbar-nav {
            text-align: center;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .table thead th {
            background-color: #007bff;
            color: white;
        }
        .alert {
            margin-top: 20px;
        }
        .btn {
            margin: 2px;
        }
        .footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Tableau de Bord</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('zones.index') }}">Gestion des Zones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('immeubles.index') }}">Gestion des Immeubles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('clients.index') }}">Gestion des Clients</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('clients.notPaid') }}">Clients Non Payés</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appartements.index') }}">Gestion des Appartements</a>
                </li>
            </ul>
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-flex">
                    @csrf
                    <button class="btn btn-outline-light ms-2" type="submit">Déconnexion</button>
                </form>
            @endauth
        </div>
    </div>
</nav>

    <div class="container mt-4">
        @yield('content')
    </div>
    <footer class="footer">
        <p>&copy; {{ date('Y') }} Votre Application. Tous droits réservés.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
