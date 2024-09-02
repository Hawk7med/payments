@extends('layouts.app')
@section('style')
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-center">
                    <h3 class="fw-light my-4">Connexion</h3>
                </div>
                <div class="card-body">
                    <!-- Affichage des erreurs de validation -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Adresse E-mail</label>
                            <input id="email" type="email" class="form-control form-control-lg" name="email" required autofocus>
                        </div>

                        <div class="form-group mb-4">
                            <label for="password" class="form-label">Mot de Passe</label>
                            <input id="password" type="password" class="form-control form-control-lg" name="password" required>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
