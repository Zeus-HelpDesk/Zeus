@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Districts') }} <a href="{{ url('/admin/locations/create') }}"
                                                                      class="btn btn-sm btn-outline-primary float-right">Create
                            District</a></div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Buildings') }}</th>
                                <th>{{ __('Users') }}</th>
                                <th>{{ __('Options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($districts as $district)
                                <tr>
                                    <td>{{ $district->name }}</td>
                                    <td>{{ $district->phone_number }}</td>
                                    <td>{{ $district->code }}</td>
                                    <td>{{ $district->buildings()->count() }}</td>
                                    <td>{{ $district->users()->count() }}</td>
                                    <td>
                                        <a href="{{ url('/admin/locations/' . $district->id) }}"
                                           class="btn btn-sm btn-outline-primary"><em class="iconify"
                                                                                     data-icon="mdi:eye"></em></a>
                                        <a href="{{ url('/admin/locations/' . $district->id . '/edit') }}"
                                           class="btn btn-sm btn-outline-warning"><em class="iconify"
                                                                                     data-icon="mdi:pencil"></em></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
