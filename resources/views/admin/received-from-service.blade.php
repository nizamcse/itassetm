@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">ASSET RECEIVED FROM SERVICE</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="assetReceivedFromService" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Asset ID</th>
                    <th>Name</th>
                    <th>Received At</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assets as $asset)
                    <tr>
                        <td>{{ $asset->id }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>{{ $asset->status_date }}</td>
                        <td>
                            <a href="#" class="btn btn-danger flat btn-xs">ACTION</a>
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

            $('#assetReceivedFromService').DataTable();
        });

    </script>
@endsection