@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">ISSUED ASSETS</h3>
        </div>

        @if(!count($issues))
            <div class="box-body" style="border-radius: 0px">
                <h4 class="text-warning">Sorry! There is no asset issued yet.</h4>
            </div>
        @else
            <div class="box-body" style="border-radius: 0px">
                <table class="table table-bordered table-striped showDatatable">
                    <thead>
                    <tr>
                        <th>ASSET ID</th>
                        <th>ASSET NAME</th>
                        <th>ISSUED TO</th>
                        <th>ISSUED QTY</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($issues as $issue)
                        @foreach($issue->issueDetails as $issue_details)
                            <tr>
                                <td>{{ $issue_details->asset->id }}</td>
                                <td>{{ $issue_details->asset->name }}</td>
                                <td>{{ $issue_details->employee->name}}</td>
                                <td>{{ $pr_details->quantity }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif


        <!-- /.row -->
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            $('.showDatatable').DataTable();
        });

    </script>
@endsection