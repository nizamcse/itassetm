@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">ASSET LOG</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="assetLog" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Asset ID</th>
                    <th>Log</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($asset_logs as $asset_logs)
                    <tr>
                        <td>{{ $asset_logs->id }}</td>
                        <td>{{ $asset_logs->asset_id }}</td>
                        <td>{{ $asset_logs->asset_log }}</td>
                        <td>{{ $asset_logs->updated_at }}</td>
                        <td>
                            <a href="{{ route('delete-log',['id' => $asset_logs->id]) }}" class="btn btn-danger flat btn-xs">DELETE</a>
                        </td>
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

            $('#assetLog').DataTable();
        });

    </script>
@endsection