@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 px-5 d-flex justify-content-between align-items-center flex-column">
            <h1>Le tue Impostazioni</h1>
            <a href="{{ url('admin') }}" class="btn btn-secondary shadow px-5 py-2 my-3">Torna alla dashboard</a>
        </div>

        @include('includes.alert')
        {{-- MOBILE --}}

        @foreach($styles as $style)
        <div class="col-sm d-sm-block px-5 d-md-none my-2">
            <div class="card">
                <div class="card-body">
                    <h6 class="my-2">Font Size Categoria: {{ $style->font_size_cat }}px</h6>
                    <h6 class="my-2">Font Size Prodotti: {{ $style->font_size }}px</h6>

                    <div class="d-flex justify-content-between align-items-center my-2">
                        <h6>Colore Accordion: </h6>
                        <div class="rounded shadow" style="width: 60px; height: 40px; background-color: {{ $style->color_accordion }}"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center my-2">
                        <h6>Colore Testo: </h6>
                        <div class="rounded shadow" style="width: 60px; height: 40px; background-color: {{ $style->color_item }}"></div>
                    </div>
                    <a href="{{ route('admin.styles.edit', $style->id) }}" class="btn btn-secondary mx-2">Modifica</a>
                </div>
            </div>
        </div>
        @endforeach

        {{-- FULL SCREEN --}}
        <div class="col-12  d-none col-md-12 d-md-block mt-5 px-5">

            @if(count($styles) == null)
            <div class="d-flex justify-content-center my-3">
                <h2 class="me-3">Crea la tua impostazione</h2>
                <a href="{{ route('admin.styles.create') }}" class="btn btn-secondary shadow px-5 py-2 ">Crea</a>
            </div>
            @endif

            <table class="table shadow">
                <thead>
                    <tr>
                        <th>Font Size Categoria</th>
                        <th>Font Size Prodotti</th>
                        <th>Colore Accordion</th>
                        <th>Colore Testo</th>
                        <th>Valore Accordion</th>
                        <th>Valore Testo</th>
                        <th class="text-end">Modifica</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($styles as $style)
                    <tr>
                        <td>{{ $style->font_size_cat }}px</td>
                        <td>{{ $style->font_size }}px</td>
                        <td>
                            <div class="rounded shadow" style="width: 80px; height: 50px; background-color: {{ $style->color_accordion }}"></div>
                        </td>
                        <td>
                            <div class="rounded shadow" style="width: 80px; height: 50px; background-color: {{ $style->color_item }}"></div>
                        </td>
                        <td>{{ $style->color_accordion }}</td>
                        <td>{{ $style->color_item }}</td>

                        <td>
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="{{ route('admin.styles.edit', $style->id) }}" class="btn btn-secondary  mx-2">Modifica</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Non ci sono stili in lista</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
