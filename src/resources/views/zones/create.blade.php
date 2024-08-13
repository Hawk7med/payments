

@section('content')
<div class="container">
    <h1>Créer une nouvelle zone</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('zones.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom de la zone</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>

