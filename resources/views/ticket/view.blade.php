@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ticket') }} - {{ $ticket->hash }}</div>
                    <div class="card-body">
                        {!! $ticket->html_description !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Details</div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">District</dt>
                            <dd class="col-sm-8">{{ $ticket->district->name }}</dd>

                            <dt class="col-sm-4">Building</dt>
                            <dd class="col-sm-8">{{ $ticket->building->name }}</dd>

                            <dt class="col-sm-4">Room</dt>
                            <dd class="col-sm-8">{{ $ticket->user->room }}</dd>
                        </dl>
                        <div class="dropdown-divider"></div>
                        <dl class="row">
                            <dt class="col-sm-4">Status</dt>
                            <dd class="col-sm-8">{{ $ticket->status->name }}</dd>

                            <dt class="col-sm-4">Priority</dt>
                            <dd class="col-sm-8">{{ $ticket->priority->name }}</dd>

                            <dt class="col-sm-4">Category</dt>
                            <dd class="col-sm-8">{{ $ticket->category->name }}</dd>
                        </dl>
                        <div class="dropdown-divider"></div>
                        <dl class="row">
                            <dt class="col-sm-4">Author</dt>
                            <dd class="col-sm-8">{{ $ticket->user->name }}</dd>

                            <dt class="col-sm-4">Created</dt>
                            <dd class="col-sm-8">
                                <timeago datetime="{{ $ticket->created_at }}"></timeago>
                            </dd>

                            <dt class="col-sm-4">Updated</dt>
                            <dd class="col-sm-8">
                                <timeago datetime="{{ $ticket->updated_at }}"></timeago>
                            </dd>
                        </dl>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection