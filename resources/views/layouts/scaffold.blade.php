@extends(config('email-login.app_shell_template'))

@push('vendor-assets')
<link href="{{ asset(config('email-login.app_assets_path') . '/css/app.css') }}" rel="stylesheet">
<script src="{{ asset(config('email-login.app_assets_path') . '/js/app.js') }}" defer></script>
@endpush

@section('scaffold')
<div class="min-h-screen"
    style="background:url({{config('app.ui.auth_image_url')}}) no-repeat 50% 90%; background-size: cover;">
    <section>
        <div class="container mx-auto py-16">
            @yield('page')
        </div>
    </section>
</div>
@endsection
