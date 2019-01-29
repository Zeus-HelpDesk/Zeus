@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Your Open Tickets') }}</div>

                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Last Update') }}</th>
                                <th>{{ __('Last Comment') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($open as $ticket)
                                <tr>
                                    <td><a href="{{ url("/ticket/$ticket->hash") }}">{{ $ticket->hash }}</a></td>
                                    <td>{!! Markdown::convertToHtml(str_limit($ticket->description)) !!}</td>
                                    <td>
                                        <timeago datetime="{{ $ticket->updated_at }}" :auto-update="60"></timeago>
                                    </td>
                                    <td>
                                        <timeago
                                                datetime="{{ $ticket->comments->first()->updated_at ?? 'No Comments' }}"
                                                :auto-update="60"></timeago>
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
