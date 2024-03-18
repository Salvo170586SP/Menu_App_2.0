@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('La tua dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="text-center">
                        <h1 class="mb-3">Benvenuto {{ucfirst(Auth::user()->name)}}</h1>

                        <h5 class="mb-3">Le tue liste</h5>
                        <h6>*Crea prima le tue categorie se vuoi associarle ai tuoi prodotti</h6>

                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="fw-bold">LISTA</div>
                                <span>Elementi in lista</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="fw-bold"> <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">Categorie</a></div>
                                <span class="badge bg-secondary rounded-pill">{{ count($categories) }}</span>
                            </li>
                            @if(count($categories) > 0)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="fw-bold"> <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Prodotti</a></div>
                                <span class="badge bg-secondary rounded-pill">{{ count($products) }}</span>
                            </li>
                            @endif
                        </ul>

                        <ul class="list-group mt-2">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="fw-bold">Modifica la tua home</div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="fw-bold"> <a class="btn btn-secondary" href="{{ route('admin.styles.index') }}">Le tue impostazioni</a></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
