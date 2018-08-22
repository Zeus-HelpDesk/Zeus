@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="invite_code"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Invite Code') }}</label>
                                <div class="col-md-6">
                                    <input id="invite_code" type="text"
                                           class="form-control{{ $errors->has('invite_code') ? ' is-invalid': '' }}"
                                           name="invite_code" value="{{ old('invite_code') }}" placeholder="EXPL-CODE"
                                           required autofocus>
                                    @if ($errors->has('invite_code'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('invite_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" placeholder="John Doe" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" placeholder="john.doe@example.com"
                                           required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="room"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Room') }}</label>

                                <div class="col-md-6">
                                    <input id="room" type="text"
                                           class="form-control{{ $errors->has('room') ? ' is-invalid' : '' }}"
                                           name="room" value="{{ old('room') }}" placeholder="123A" required>

                                    @if ($errors->has('room'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('room') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text"
                                           class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                           name="phone_number" value="{{ old('phone_number') }}"
                                           placeholder="(Optional) 440-555-4564">

                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_extension"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Phone Extension') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_extension" type="text"
                                           class="form-control{{ $errors->has('phone_extension') ? ' is-invalid' : '' }}"
                                           name="phone_extension" value="{{ old('phone_extension') }}"
                                           placeholder="(Optional) 1234">

                                    @if ($errors->has('phone_extension'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_extension') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
