@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center py-5">
            <h1 class="text-3xl my-9">Modifica Categoria</h1>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary shadow">Torna alla lista</a>
        </div>
        <div class="col-12">
            @include('includes.errorsAlert')
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post" class="mt-5" enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('admin.categories.form')
                <p>* i campi sono obbligatori</p>
                <button type="submit" class="btn btn-primary shadow">Modifica</button>
            </form>
        </div>
    </div>
</div>
@endsection
