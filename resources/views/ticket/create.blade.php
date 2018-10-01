@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Create Ticket') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/ticket/create') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="description">{{ __('Description') }}</label>
                                <div class="col-md-12">
                                    <markdown-input class="{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                                    box-id="description" box-name="description"
                                                    value="{{ old('description') }}"></markdown-input>
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <label for="priority_id">{{ __('Priority') }}</label>
                                    <select id="priority_id" name="priority_id"
                                            class="custom-select{{ $errors->has('priority_id') ? ' is-invalid' : '' }}">
                                        <option>Select a priority</option>
                                        @foreach($priorities as $priority)
                                            <option value="{{ $priority->id }}">{{ $priority->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('priority_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('priority_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col">
                                    <label for="category_id">{{ __('Category') }}</label>
                                    <select id="category_id" name="category_id"
                                            class="custom-select{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
                                        <option>Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <button type="submit" class="btn btn-primary">Create Ticket</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
