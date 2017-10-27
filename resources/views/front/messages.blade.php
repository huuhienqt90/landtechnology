@if (session('alert-danger'))
    <div class="container">
        <div class="row">
            <div class="alert alert-danger" style="margin-top: 20px;" role="alert">{{ session('alert-danger') }}</div>
        </div>
    </div>
@endif
@if (session('alert-success'))
    <div class="container">
        <div class="row">
            <div class="alert alert-success" style="margin-top: 20px;" role="alert">{{ session('alert-success') }}</div>
        </div>
    </div>
@endif
