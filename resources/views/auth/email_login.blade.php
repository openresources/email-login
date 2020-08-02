@extends('email-login::layouts.scaffold')

@section('page__title', 'Email Login')

@section('page')
<div class="container mx-auto">
    <div class="flex flex-col flex-wrap items-center justify-start">
        <p class="bg-gray-400 opacity-75 rounded mb-4 font-medium text-lg 
                  text-center italic py-4 w-full max-w-sm leading-snug">
            @lang('Confirm your email address')</p>
        <div class="w-full max-w-sm">
            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

                <form class="w-full p-6" method="POST" action="{{ route('email-login.login') }}">
                    @csrf

                    <div class="form-row">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <p class="text-red-500 text-xs italic mt-4">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="form-row">
                        <button type="submit"
                            class="btn btn-primary">
                            {{ __('Verify email') }}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
