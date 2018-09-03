@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Users') }} <a class="btn btn-sm btn-outline-primary"
                                                                  href="">{{ __('Create User') }}</a></div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('E-Mail') }}</th>
                                <th>{{ __('Room') }}</th>
                                <th>{{ __('Staff') }}</th>
                                <th>{{ __('Options') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($building->users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->room }}</td>
                                    <td><input type="checkbox" class="custom-control-input"
                                               {{ $user->staff ? 'checked' : '' }} disabled></td>
                                    <td>
                                        <a href="{{ url('/admin/users/' . $user->id) }}"
                                           class="btn btn-sm btn-outline-primary"><i class="mdi mdi-eye"></i></a>
                                        <a href="{{ url('/admin/users/' . $user->id . '/edit') }}"
                                           class="btn btn-sm btn-outline-warning"><i class="mdi mdi-pencil"></i></a>
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