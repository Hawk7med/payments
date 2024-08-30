<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .parallax {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            height: 100vh;
            position: relative;
        }

        .parallax1 {
            background-image: url('{{ asset("assets/img/1.jpg") }}');
        }

        .parallax2 {
            background-image: url('{{ asset("assets/img/2.jpg") }}');
        }

        .parallax3 {
            background-image: url('{{ asset("assets/img/6.jpg") }}');
        }

        .content {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .btn-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-login {
            font-size: 1.2rem;
            padding: 10px 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .btn-login:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        }

    </style>
</head>
<body>

    <!-- Parallax Section 1 -->
    <div class="parallax parallax1">
        <div class="content">
            <h1>Bienvenue sur notre plateforme</h1>
        </div>
    </div>

    <!-- Parallax Section 2 -->
    <div class="parallax parallax2">
        <div class="content">
            <h1>Découvrez nos services</h1>
        </div>
    </div>

    <!-- Parallax Section 3 -->
    <div class="parallax parallax3">
        <div class="content">
            <div class="btn-container">
                <h1>Rejoignez-nous maintenant</h1>
                <a href="{{ route('login') }}" class="btn btn-primary btn-login">Connexion</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
