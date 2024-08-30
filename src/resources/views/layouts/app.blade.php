<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Zones')</title>
    <!-- Local Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Local Material Design Icons CSS -->
    <link href="{{ asset('assets/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="././css/app.css" rel="stylesheet">
    @yield('style')
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
    @auth
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
                        <a class="nav-link" href="{{ route('appartements.index') }}">Gestion des Appartements</a>
                    </li>
                    @if((Auth::user()->role === 'admin')||Auth::user()->role === 'super admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">Gérer les utilisateurs</a>
                        </li>
                    @endif
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('change-password') }}">Changer le mot de passe</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light" type="submit">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endauth

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <footer class="footer">
        <p>&copy; {{ date('Y') }} Votre Application. Tous droits réservés.</p>
    </footer>

    <!-- Local Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Local jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
</body>
</html>
