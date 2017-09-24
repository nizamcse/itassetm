@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">SUPPORT TICKETS</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="{{ asset('public/dist/img/user1-128x128.jpg') }}" alt="User Image">
                        <span class="username">Ticket No #{{ $support_ticket->id }}</span>
                        <span class="username"><a href="#">{{ $support_ticket->user->name }}</a></span>
                        <span class="description">{{ $support_ticket->department->name }} - {{ $support_ticket->created_at }}</span>
                    </div>
                    @if($support_ticket->user_id == Auth::user()->id || $support_ticket->department->user()->contains(Auth::user()->id))
                        <div class="box-tools">
                            <div class="btn-group btn-group-sm">
                                <button type="button" class="btn {{ $support_ticket->status ? 'btn-success' : 'btn-danger' }} btn-flat">{{ $support_ticket->status ? 'Open' : 'Closed' }}</button>
                                <button type="button" class="btn {{ $support_ticket->status ? 'btn-success' : 'btn-danger' }} btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('change-support-ticket-status',['id' => $support_ticket->id, 'status' => $support_ticket->status ? 0 : 1]) }}">{{ !$support_ticket->status ? 'Open' : 'Close' }}</a></li>
                                </ul>
                            </div>
                        </div>
                    @endif
                <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <h3>{{ $support_ticket->title }}</h3>
                    <div class="question">
                        {{ $support_ticket->complain }}
                    </div>
                    @if($support_ticket->document)
                        <div class="attachment-block clearfix">
                            <stront>Attachment</stront># <a target="_blank" href="{{ asset('public/documents/'.$support_ticket->document) }}">{{ $support_ticket->document }}</a>
                        </div>
                    @endif
                    <span class="pull-right text-muted">{{ count($support_ticket->answare) }} response</span>
                </div>
                <!-- /.box-body -->
                <div class="box-footer box-comments">
                    @foreach($support_ticket->answare as $ans)
                        <div class="box-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="{{ asset('public/dist/img/user3-128x128.jpg') }}" alt="User Image">

                            <div class="comment-text">
                                  <span class="username">
                                    {{ $ans->user->name }}
                                      <span class="text-muted pull-right">{{ $ans->created_at }}</span>
                                  </span>
                                <div class="ans">
                                    {{ $ans->ans }}
                                </div>
                            </div>
                            <!-- /.comment-text -->
                        </div>
                    @endforeach
                </div>
                <!-- /.box-footer -->
                <div class="box-footer">
                    @if($support_ticket->department->users->contains(Auth::user()->id) && $support_ticket->status == 1)
                        <form action="{{ route('support-ticket-answare',['id' => $support_ticket->id]) }}" method="post">
                            {{ csrf_field() }}
                            <img class="img-responsive img-circle img-sm" src="{{ asset('public/dist/img/user4-128x128.jpg') }}" alt="Alt Text">
                            <!-- .img-push is used to add margin to elements next to floating images -->
                            <div class="img-push">
                                <div class="row">
                                    <div class="col-md-10">
                                        <input type="text" name="ans" class="form-control input-sm" placeholder="Press enter to post comment">
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn flat btn-info btn-sm pull-right" type="submit">SAVE</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
                <!-- /.box-footer -->
            </div>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {
        });

    </script>
@endsection