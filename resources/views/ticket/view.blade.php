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
                @foreach($ticket->comments as $comment)
                    <div class="card mt-2">
                        <div class="card-body">
                            {!! $comment->html_comment !!}
                        </div>
                        <div class="card-footer">
                            <div class="text-muted">
                                <timeago datetime="{{ $comment->created_at }}" :auto-update="60"></timeago>
                                from {{ $comment->user->name }}
                                <div class="flex"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="card mt-2">
                    <div class="card-body">
                        <form method="POST" action="{{ url("/ticket/$ticket->hash/comment/create") }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <markdown-input class="{{ $errors->has('comment') ? ' is-invalid' : '' }}"
                                                    box-id="comment" box-name="comment"
                                                    value="{{ old('comment') }}"></markdown-input>
                                    @if ($errors->has('comment'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('comment') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row justify-content-center">
                                <button type="submit" class="btn btn-raised btn-primary">Post Comment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#details" role="tab"
                                   aria-controls="details" aria-selected="true">Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#computer" role="tab"
                                   aria-controls="computer" aria-selected="false">Computer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                   aria-controls="contact" aria-selected="false">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="details" role="tabpanel"
                                 aria-labelledby="details-tab">
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
                                    <dt class="col-sm-4">Created</dt>
                                    <dd class="col-sm-8">
                                        <timeago datetime="{{ $ticket->created_at }}" :auto-update="60"></timeago>
                                    </dd>

                                    <dt class="col-sm-4">Updated</dt>
                                    <dd class="col-sm-8">
                                        <timeago datetime="{{ $ticket->updated_at }}" :auto-update="60"></timeago>
                                    </dd>
                                </dl>
                            </div>
                            <div class="tab-pane fade" id="computer" role="tabpanel" aria-labelledby="computer-tab">
                                <div class="alert alert-info" role="alert">
                                    Feature Coming Soon!
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <dl class="row">
                                    <dt class="col-sm-4">Name</dt>
                                    <dd class="col-sm-8">{{ $ticket->user->name }}</dd>

                                    <dt class="col-sm-4">E-Mail</dt>
                                    <dd class="col-sm-8"><a
                                                href="mailto:{{ $ticket->user->email }}">{{ $ticket->user->email }}</a>
                                    </dd>

                                    @if($ticket->user->phone_number)
                                        <dt class="col-sm-4">Phone</dt>
                                        <dd class="col-sm-8">{{ $ticket->user->phone_number }}</dd>
                                    @endif

                                    @if($ticket->user->phone_extension)
                                        <dt class="col-sm-4">Extension</dt>
                                        <dd class="col-sm-8">{{ $ticket->user->phone_extension }}</dd>
                                    @endif
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
