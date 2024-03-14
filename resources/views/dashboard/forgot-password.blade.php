@extends('dashboard.main')

@section('content')
<div class="flex items-center justify-center container pt-32">
    <div class="border border-black rounded-md">
            <div class="card">
                <div class="card-header text-2xl text-center font-bold bg-teknik text-white p-6">{{ __('Reset Password') }}</div>

                <div class="card-body p-5">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <div class="">
                            <label for="email" class="font-bold">{{ __('E-Mail Address') }}</label>

                            <div class="mb-4 mt-2">
                                <input id="email" type="email" class="w-108 rounded-md text-base @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="">
                                <button type="submit" class="bg-amber-600 text-base text-white hover:bg-blue-500 font-bold p-2.5 rounded-md mr-2">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>

@endsection
