<div class="row">

    <div class="col-md-4 mb-2">
        <label>Categoria</label>
        <select class="form-select" name="category_id">
            <option value="" selected>Seleziona una categoria</option>
            @foreach ($categories as $category)
            <option @if (isset($product)) value="{{ old('category_id', $category->id) }}" @selected($product->category_id == $category->id)
                @else
                value="{{ $category->id }}" @endif >{{ $category->name_category }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    {{-- <div class="col-md-4 mb-2">
        <label>Categoria in inglese</label>
        <select class="form-select" name="category_id">
            <option value="" selected>Seleziona una categoria</option>
            @foreach ($categories as $category)
            <option @if (isset($product)) value="{{ old('category_id', $category->id) }}" @selected($product->category_id == $category->id)
                @else
                value="{{ $category->id }}" @endif >{{ $category->name_category_eng }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div> --}}
    <div class="col-md-4 mb-2">
        <label for="aperitif-name">Nome(*)</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', isset($product) ? $product->name : '') }}" name="name" id="aperitif-name" required>
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-4 mb-2">
        <label for="aperitif-name">Nome Inglese</label>
        <input type="text" class="form-control @error('name_eng') is-invalid @enderror" value="{{ old('name_eng', isset($product) ? $product->name_eng : '') }}" name="name_eng" id="aperitif-name">
        @error('name_eng')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-4 mb-2">
        <label for="aperitif-name">Produttore</label>
        <input type="text" class="form-control @error('manufacturer') is-invalid @enderror" value="{{ old('name', isset($product) ? $product->manufacturer : '') }}" name="manufacturer" id="aperitif-name">
        @error('manufacturer')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-4 mb-2">
        <label for="aperitif-price">Quantità cl</label>
        <input type="text" class="form-control @error('quantity_cl') is-invalid @enderror" value="{{ old('quantity_cl', isset($product) ? $product->quantity_cl : '') }}" id="aperitif-price" name="quantity_cl">
        @error('quantity_cl')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-4 mb-2">
        <label for="aperitif-price">Quantità lt</label>
        <input type="text" class="form-control @error('quantity_lt') is-invalid @enderror" value="{{ old('quantity_lt', isset($product) ? $product->quantity_lt : '') }}" id="aperitif-price" name="quantity_lt">
        @error('quantity_lt')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="col-md-4 mb-2">
        <label for="aperitif-price">Prezzo Intero</label>
        <input type="text" placeholder="0.00€" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', isset($product) ? $product->price : '') }}" id="aperitif-price" name="price">
        @error('price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-4 mb-2">
        <label for="aperitif-price">Prezzo Bottiglia</label>
        <input type="text" placeholder="0.00€" class="form-control @error('price_bottle') is-invalid @enderror" value="{{ old('price_bottle', isset($product) ? $product->price_bottle : '') }}" id="aperitif-price" name="price_bottle">
        @error('price_bottle')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-4 mb-2">
        <label for="aperitif-price">Prezzo Calice</label>
        <input type="text" placeholder="0.00€" class="form-control @error('price_goblet') is-invalid @enderror" value="{{ old('price_goblet', isset($product) ? $product->price_goblet : '') }}" id="aperitif-price" name="price_goblet">
        @error('price_goblet')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
   

    <div class="col-12 col-md-6 mt-3">
        <label for="aperitif-description">Descrizione</label>
        <textarea name="description" class="form-control mb-5 @error('description') is-invalid @enderror" id="aperitif-description" cols="30" rows="5">{{ old('description', isset($product) ?  $product->description : '') }}</textarea>
        @error('description')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-12 col-md-6 mt-3">
        <label for="aperitif-description">Descrizione Inglese</label>
        <textarea name="description_eng" class="form-control mb-5 @error('description_eng') is-invalid @enderror" id="aperitif-description" cols="30" rows="5">{{ old('description_eng', isset($product) ?  $product->description_eng : '') }}</textarea>
        @error('description_eng')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-3 mb-5">
        <label for="img">Immagine prodotto</label>
        <input type="file" class="form-control" id="img" name="url_img">
    </div>
</div>
