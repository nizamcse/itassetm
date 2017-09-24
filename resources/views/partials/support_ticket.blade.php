
<div class="box box-widget">
    <div class="box-header with-border">
        <div class="user-block">
            <img class="img-circle" src="{{ asset('public/dist/img/user1-128x128.jpg') }}" alt="User Image">
            <span class="username">Ticket No #{{ $support_ticket->id }}</span>
            <span class="username"><a href="#">{{ $support_ticket->user->name }}</a></span>
            <span class="description">{{ $support_ticket->department->name }} - {{ $support_ticket->created_at }}</span>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="question-text">
            <a href="{{ route('support-ticket',['id' => $support_ticket->id]) }}">
                {{ $support_ticket->complain }}
            </a>
        </div>
        @if($support_ticket->document)
            <div class="attachment-block clearfix">
                <stront>Attachment</stront># <a href="{{ asset('public/documents/'.$support_ticket->document) }}">{{ $support_ticket->document }}</a>
            </div>
        @endif
        <span class="pull-right text-muted">{{ count($support_ticket->answare) }} response</span>
    </div>
</div>
