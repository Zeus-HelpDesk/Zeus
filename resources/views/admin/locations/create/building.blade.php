@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Create Building') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url("/admin/locations/$district->id/create") }}"
                              aria-label="{{ __('Create Building') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                           class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                           name="address" value="{{ old('address') }}" required>

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_number" type="text"
                                           class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                           name="phone_number" value="{{ old('phone_number') }}">

                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_extension"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Phone Extension') }}</label>

                                <div class="col-md-6">
                                    <input id="phone_extension" type="text"
                                           class="form-control{{ $errors->has('phone_extension') ? ' is-invalid' : '' }}"
                                           name="phone_extension" value="{{ old('phone_extension') }}">

                                    @if ($errors->has('phone_extension'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_extension') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="code"
                                       class="col-sm-4 col-form-label text-md-right">{{ __('Code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text"
                                           class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                           name="code" value="{{ old('code') }}">

                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create Building') }}
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