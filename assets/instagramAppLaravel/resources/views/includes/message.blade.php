@if(session('message'))
    <div class="alert-success">
        {{-- variable enviada en el método update de UserController --}}
        {{ session('message') }}
    </div>
@endif
