@if(session('message'))
<div class="container-fluid px-5">
    <div class="d-flex justify-content-center">
        <div class="alert alert-info px-5 alert-dismissible fade show my-2" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>

@endif
