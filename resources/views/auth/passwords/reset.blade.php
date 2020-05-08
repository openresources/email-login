@extends('email-login::layouts.scaffold')

@section('page__title', 'Email Login')

@section('page')

<div class="container mx-auto">
    <div class="flex flex-col flex-wrap items-center justify-start">
        @if (session('status'))
        <div class="alert alert-success text-center mb-4">
            {{ session('status') }}
        </div>
        @endif
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    {{ __('Set Password') }}
                </div>

                <form class="w-full p-6" method="POST" action="{{ route('email-login.password.reset') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="flex flex-wrap mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap mb-6">
                        <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="form-input w-full"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold  py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
