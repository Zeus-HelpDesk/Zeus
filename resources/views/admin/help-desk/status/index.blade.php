@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Status') }} <a href="{{ url('/admin/help-desk/status/create') }}"
                                                                   class="btn btn-sm btn-outline-primary float-right">Create
                            Status</a></div>

                    <div class="card-body table-responsive">
                        @if(!empty($statuses))
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Description') }}</th>
                                    <th>{{ __('Closes Ticket') }}</th>
                                    <th>{{ __('Options') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($statuses as $status)
                                    <tr>
                                        <td>{{ $status->name }}</td>
                                        <td>{{ $status->description }}</td>
                                        <td>{{ $status->closes_ticket }}</td>
                                        <td>
                                            <a href="{{ url('/admin/help-desk/status/edit/' . $status->id) }}"
                                               class="btn btn-sm btn-outline-warning"><em class="iconify"
                                                                                         data-icon="mdi:pencil"></em></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <img src="{{ asset('images/empty.svg') }}" alt="Empty" class="img-thumbnail"
                                 style="background-color: transparent; border: none;">
                            <h3 class="text-center">
                                <small class="text-muted">Yikes its a bit empty here, try creating a status</small>
                            </h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
