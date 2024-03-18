@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="text-3xl my-9">Crea Prodotto</h1>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary shadow">Torna alla lista</a>
        </div>
        <div class="col-12">
            @include('includes.errorsAlert')
            <form action="{{ route('admin.products.store') }}" method="post" class="mt-5" enctype="multipart/form-data">
                @csrf
                @include('admin.products.form')
                <p>* i campi sono obbligatori</p>

                <button class="btn btn-primary shadow">Crea</button>
            </form>

        </div>
    </div>
</div>
@endsection
