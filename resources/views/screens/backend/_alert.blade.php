@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Well done: </strong> {!! session('success') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('failed'))
    <div class="alert alert-danger alert-dismissible fade show">
        <strong>Warning: </strong> {!! session('failed') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if($errors->all())
    <div class="alert alert-danger alert-dismissible fade show">
        <strong>Warning: </strong> Please check the form carefully for errors!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('msg'))
    <div class="alert alert-danger alert-dismissible fade show">
        <strong>Error: </strong> {{ session('msg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif