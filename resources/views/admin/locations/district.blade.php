@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Buildings') }} <a
                                href="{{ url('/admin/locations/' . $district->id . '/create') }}"
                                class="btn btn-sm btn-outline-primary float-right">Create Building</a></div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Code') }}</th>
                                <th>{{ __('Users') }}</th>
                                <th>{{ __('Options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($district->buildings as $building)
                                <tr>
                                    <td>{{ $building->name }}</td>
                                    <td>{{ $building->phone_number }}</td>
                                    <td>{{ $building->code }}</td>
                                    <td>{{ $building->users()->count() }}</td>
                                    <td>
                                        <a href="{{ url('/admin/locations/' . $district->id . '/' . $building->id) }}"
                                           class="btn btn-sm btn-outline-primary"><i
                                                    class="iconify" data-icon="mdi:eye"></i></a>
                                        <a href="{{ url('/admin/locations/' . $district->id . '/' . $building->id . '/edit') }}"
                                           class="btn btn-sm btn-outline-warning"><i class="iconify"
                                                                                     data-icon="mdi:pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection