@extends('front.layouts.app')

@section('content')

<div class="flex justify-center mt-8">
    <div class="w-full max-w-sm">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <h2>Kirjaudu</h2>
            <div class="mb-4 mt-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="email">
                    Sähköposti
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker{{ $errors->has('email') ? ' border-danger mb-3' : '' }}" name="email" id="email" type="email" placeholder="Sähköposti" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <p class="text-danger text-xs italic">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                    Salasana
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker{{ $errors->has('password') ? ' border-danger mb-3' : '' }}" name="password" id="password" type="password" placeholder="Salasana" required>
                @if ($errors->has('password'))
                    <p class="text-danger text-xs italic">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="mb-6">
                <label class="cursor-pointer">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Muista minut
                </label>
            </div>
            <div class="flex items-center justify-between">
                <button class="btn" type="submit">
                    Kirjaudu
                </button>
                <a class="inline-block align-baseline font-bold text-sm no-underline text-link hover:text-link-dark" href="{{ route('password.request') }}">
                    Unohtuiko salasana?
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
