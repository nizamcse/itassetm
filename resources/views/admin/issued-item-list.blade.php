@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">ISSUED ITEM LIST</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="issuedItems" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Issue No</th>
                    <th>Asset ID</th>
                    <th>Asset Name</th>
                    <th>Issued To</th>
                    <th>Documentation</th>
                </tr>
                </thead>
                <tbody>
                @foreach($issued_assets as $issued_asset)
                    @if($issued_asset->asset)
                        <tr>
                            <td>{{ $issued_asset->id }}</td>
                            <td><a href="#">{{ $issued_asset->asset->id }}</a></td>
                            <td><a href="#">{{ $issued_asset->asset->name }}</a></td>
                            <td>{{ $issued_asset->employee->name }}</td>
                            <td><a href="{{ route('view-issued-item-doc',['id' => $issued_asset->itemDoc->id]) }}">View Details</a></td>
                        </tr>
                    @endif
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

            $('#issuedItems').DataTable();
        });

    </script>
@endsection