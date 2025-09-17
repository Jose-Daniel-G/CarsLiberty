@if (session('success'))
    <h6 class="alert alert-success">
        {{ session('success') }}
    </h6>
@endif
@if (session('error'))
    <h6 class="alert alert-danger">
        {{ session('error') }}
    </h6>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
