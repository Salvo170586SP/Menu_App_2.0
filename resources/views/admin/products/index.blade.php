@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 px-5 d-flex justify-content-between align-items-center flex-column">
            <h1>Lista Prodotti</h1>
            <a href="{{ url('admin') }}" class="btn btn-secondary shadow px-5 py-2 mt-4">Torna alla dashboard</a>
        </div>
        <div class="col-12 px-5 col-sm d-sm-block d-md-none mt-4">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-5 py-2 shadow mb-3 my-3 ">Crea</a>
        </div>
        @include('includes.alert')
        {{-- MOBILE --}}
        <div class="col-12 px-3 d-sm-block d-md-none ">{{ $products->onEachSide(1)->links() }}</div>
        @foreach($products as $product)
        <div class="col-sm d-sm-block px-5 d-md-none my-2">
            <div class="card">
                <div class="card-body">
                    @if(file_exists(public_path('storage/' . $product->url_img)) && $product->url_img)
                    <figure style="overflow: hidden; height: 70px; width: 100%" class="rounded">
                        <img src="{{ asset('storage/' . $product->url_img) }}" style="object-fit: cover; width: 100%" height="100" alt="img">
                    </figure>
                    @else
                    <div class="border rounded p-1 text-center">NO IMAGE</div>
                    @endif
                    @if(file_exists(public_path('storage/' . $product->url_img)) && $product->url_img)
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger my-3" data-bs-toggle="modal" data-bs-target="#exampleModalDeleteImgProdMobile-{{ $product->id }}">
                        Elimina img
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalDeleteImgProdMobile-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Sei sicuro di eliminare questa immagine?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('admin.products.delete_img', $product->id) }}" method="get">
                                        @csrf
                                        <button class="btn btn-outline-danger"><small>Elimina img</small></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif
                    <h5 class="card-title my-3">Nome: {{ $product->name }}</h5>
                    <h5 class="card-title mb-3">Nome inglese: @if($product->name_eng ) {{ $product->name_eng }} @else -- @endif</h5>
                    <p>Produttore: @if($product->manufacturer) {{ $product->manufacturer }} @else -- @endif</p>
                    <p class="card-text">Prezzo: @if($product->price) €{{ number_format($product->price, 2, '.', ',')  }} @else -- @endif</p>
                    <p>Prezzo Calice: @if($product->price_goblet ) {{ $product->price_goblet }} @else -- @endif</p>
                    <p>Prezzo Bottiglia: @if($product->price_bottle) {{ $product->price_bottle }} @else -- @endif</p>
                    <p>Quantità cl: @if($product->quantity_cl) {{ $product->quantity_cl }} @else -- @endif</p>
                    <p>Quantità lt: @if($product->quantity_lt) {{ $product->quantity_lt }} @else -- @endif</p>
                    <p>Categoria: @if($product->category) <span class="badge text-bg-secondary"> {{ $product->category->name_category }}</span>
                        @else -- @endif </p>
                    <p class="card-text">Descrizione: @if($product->description) {{ substr($product->description, 0, 15) }}... @else -- @endif</p>
                    <p class="card-text">Descrizione Inglese: @if($product->description_eng) {{ substr($product->description_eng, 0, 15) }}... @else -- @endif</p>
                  <div class="d-flex mt-4">
                      <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Vedi</a>
                      <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary mx-2">Modifica</a>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalMobile-{{ $product->id }}">
                        Elimina
                    </button>
                </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalMobile-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5>Sei sicuro di eliminare {{ $product->name }}?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger shadow">Elimina</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- FULL SCREEN --}}
        <div class="col-12  d-none col-md-12 d-md-block mt-5 px-5">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary shadow mb-3 px-5 py-2">Crea</a>
            <table class="table shadow">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nome Ing</th>
                        <th>Produttore</th>
                        <th>Descrizione</th>
                        <th>Descrizione ing</th>
                        <th>Prezzo</th>
                        <th>Prezzo Calice</th>
                        <th>Prezzo Bottiglia</th>
                        <th>Quantità cl</th>
                        <th>Quantità lt</th>
                        <th>Categoria</th>
                        <th>Img prodotto</th>
                        <th></th>
                        <th class="text-center">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>@if($product->name_eng){{ $product->name_eng }}@else -- @endif</td>
                        <td>@if($product->manufacturer) {{ $product->manufacturer }} @else -- @endif</td>
                        <td>@if($product->description) {{ substr($product->description, 0, 15) }}... @else -- @endif</td>
                        <td>@if($product->description_eng) {{ substr($product->description_eng, 0, 15)}}... @else -- @endif</td>
                        <td>@if($product->price) €{{ number_format($product->price, 2, '.', ',')  }} @else -- @endif</td>
                        <td>@if($product->price_goblet) €{{ number_format($product->price_goblet, 2, '.', ',')  }} @else -- @endif</td>
                        <td>@if($product->price_bottle) €{{ number_format($product->price_bottle, 2, '.', ',')  }} @else -- @endif</td>
                        <td>@if($product->quantity_cl) {{ $product->quantity_cl}}cl @else -- @endif</td>
                        <td>@if($product->quantity_lt) {{$product->quantity_lt }}lt @else -- @endif</td>
                        <td>
                            @if($product->category) <span class="badge text-bg-secondary">{{$product->category->name_category }}</span> @else -- @endif
                        </td>
                        <td>
                            @if(file_exists(public_path('storage/' . $product->url_img)) && $product->url_img)
                            <figure style="overflow: hidden; height: 50px; width: 100px" class="rounded">
                                <img src="{{ asset('storage/' . $product->url_img) }}" style="object-fit: cover" width="100" height="100" alt="img">
                            </figure>
                            @else
                            <div class="border rounded p-1 text-center">NO IMAGE</div>
                            @endif
                        </td>
                        <td>
                            @if(file_exists(public_path('storage/' . $product->url_img)) && $product->url_img)
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalFullProduct-{{ $product->id }}">
                                Elimina img
                            </button>
        
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalFullProduct-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>Sei sicuro di eliminare l'immagine?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                            <form action="{{ route('admin.products.delete_img', $product->id) }}" method="get">
                                                @csrf
                                                <button class="btn btn-outline-danger"><small>Elimina img</small></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center">
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-primary">Vedi</a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary  mx-2">Modifica</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModalDeleteProd-{{ $product->id }}">
                                    Elimina
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalDeleteProd-{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Attenzione</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Sei sicuro di eliminare {{ $product->name }}?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" data-title="{{ $product->name }}" class="delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger shadow">Elimina</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>Non ci sono prodotti in lista</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection
