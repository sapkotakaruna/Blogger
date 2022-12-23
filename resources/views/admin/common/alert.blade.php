@if(\Illuminate\Support\Facades\Session::has('success_message'))
    <div class="alert alert-success" role="alert">
        {{ \Illuminate\Support\Facades\Session::get('success_message') }}
    </div>
@endif
@if(\Illuminate\Support\Facades\Session::has('error_message'))
    <div class="alert alert-danger" role="alert">
        {{ \Illuminate\Support\Facades\Session::get('error_message') }}
    </div>
@endif
