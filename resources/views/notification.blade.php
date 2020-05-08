@extends('email-login::layouts.scaffold')

{{-- @section('page__title', "{$pageTitle ?? 'Notice'} - {$message}") --}}

@section('page')
<div class="container mx-auto">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
</div>
@endsection
