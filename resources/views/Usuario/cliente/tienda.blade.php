@extends('layouts.cliente')

@section('content')
<div class="container mt-5">

    <h2 class="fw-bold text-center mb-4">Categorías</h2>

    <div class="row">
        @foreach($categorias as $c)
            <div class="col-md-4 mb-3">
                <a href="{{ route('cliente.categoria', $c['id']) }}"
                   class="text-decoration-none">
                    <div class="card shadow-sm text-center p-4">
                        <h4 class="text-dark">{{ $c['nombre'] }}</h4>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection
