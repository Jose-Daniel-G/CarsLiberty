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