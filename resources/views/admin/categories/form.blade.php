<div class="row">
    <div class="col-md-4 mb-2">
        <label for="category-name">Nome Categoria(*)</label>
        <input type="text" class="form-control @error('name_category') is-invalid @enderror" value="{{ old('name_category', isset($category) ? $category->name_category : '') }}" name="name_category" id="category-name" required>
        @error('name_category')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-4 mb-2">
        <label for="category-name">Nome Categoria Inglese</label>
        <input type="text" class="form-control @error('name_category_eng') is-invalid @enderror" value="{{ old('name_category_eng', isset($category) ? $category->name_category_eng : '') }}" name="name_category_eng" id="category-name">
        @error('name_category_eng')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="col-md-3 mb-5">
        <label for="img_cat">Immagine categoria</label>
        <input type="file" class="form-control" id="img_cat" name="url_img">
    </div>
</div>
