@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark"  style="color: #99968b;">{{ __('Rejestracja') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nazwa:</label>

                            <div class="col-md-6">
                                <input id="name" style="color: #99968b;" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Adres email:</label>

                            <div class="col-md-6">
                                <input id="email" style="color: #99968b;" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Hasło:</label>

                            <div class="col-md-6">
                                <input id="password" style="color: #99968b;" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Powtórz hasło:</label>

                            <div class="col-md-6">
                                <input id="password-confirm" style="color: #99968b;" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="proffesion" class="col-md-4 col-form-label text-md-end">Profesja:</label>

                            <div class="col-md-4">
                                <!--
                                <div class="form-check radio-inline">
                                    <input class="form-check-input radio-inline" type="radio" name="proffesion" id="proffesionMage" value="mage">
                                    <label class="form-check-label" for="proffesionMage">
                                        Mag
                                    </label>
                                </div>
                                <div class="form-check radio-inline">
                                    <input class="form-check-input radio-inline" type="radio" name="proffesion" id="proffesionKnight" value="knight" checked>
                                    <label class="form-check-label" for="proffesionKnight">
                                        Rycerz
                                    </label>
                                </div>
-->
                                <div class="form-check">

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="proffesion" id="proffesionMage" value="mage">
                                        <label class="form-check-label" for="proffesionMage">Mag</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="proffesion" id="proffesionKnight" value="knight" checked>
                                        <label class="form-check-label" for="proffesionKnight">Rycerz</label>
                                    </div>
                                    <br>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
