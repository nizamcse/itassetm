@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">SUPPORT TICKETS</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="supportQuestion" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Ticket No</th>
                        <th>Ticket Title</th>
                        <th>Total Response</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($support_tickets as $support_ticket)
                    <tr>
                        <td>{{ $support_ticket->id }}</td>
                        <td><a href="{{ route('support-ticket',['id' => $support_ticket->id]) }}">{{ $support_ticket->title }}</a></td>
                        <td>{{ count($support_ticket->answare) }}</td>
                        <td>{{ $support_ticket->status ? 'Open' : 'Closed' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            $('#supportQuestion').DataTable();
        });

    </script>
@endsection