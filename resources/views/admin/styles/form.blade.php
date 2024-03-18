<div class="row">
    <div class="col-12 mb-5">
        <label for="file_logo" class="form-label d-flex justify-content-between">Carica logo azienda</label>
        <input type="file"  name="url_logo"   id="file_logo">
    </div>
    <div class="col-12 col-md-6 mb-2">
        <label for="customRange" class="form-label d-flex justify-content-between">Font Size Categoria</label>
        <div class="d-flex align-items-center justify-content-between">
            <p>Valore pre-impostato: @if (isset($style)) {{ $style->font_size_cat }}px @endif </p>
            <p> Nuovo valore: <span class="fs-5" id="rangeValue"> </span>px</p>
        </div>
        <input type="range" @if (isset($style)) value="{{ $style->font_size_cat }}"  data-range="{{ $style->font_size_cat }}" @endif min="0" max="40" name="font_size_cat" class="form-range" id="customRange">

    </div>
    <div class="col-12 col-md-6 mb-2">
        <label for="customRange2" class="form-label d-flex justify-content-between">Font Size Prodotti</label>
        <div class="d-flex align-items-center justify-content-between">
            <p>Valore pre-impostato: @if (isset($style)) {{ $style->font_size }}px @endif</p>
            <p> Nuovo valore: <span class="fs-5" id="rangeValue2"> </span>px</p>
        </div>
        <input type="range" @if (isset($style)) value="{{ $style->font_size }}" @endif min="0" max="40" name="font_size" class="form-range" id="customRange2">
    </div>
    <div class="col-12 col-md-6 mb-2">
        <label for="exampleColorInput" class="form-label">Colore Accordion</label>
        <input type="color" class="form-control form-control-color" value="{{ old('color_accordion', isset($style) ? $style->color_accordion : '#ffff') }}" name="color_accordion" title="Choose your color">
    </div>
    <div class="col-12 col-md-6 mb-4">
        <label for="exampleColorInput" class="form-label">Colore Testo</label>
        <input type="color" class="form-control form-control-color" value="{{ old('color_item', isset($style) ? $style->color_item : '#000') }}" name="color_item" title="Choose your color">
    </div>
</div>
