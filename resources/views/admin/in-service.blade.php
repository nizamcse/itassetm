@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">ASSET IN SERVICE</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="assetInService" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Service ID</th>
                        <th>Vendor</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assets_in_service as $asset_in_service)
                        <tr>
                            <td>{{ $asset_in_service->id }}</td>
                            <td>{{ $asset_in_service->vendor->name }}</td>
                            <td>{{ $asset_in_service->vendor_contact_details }}</td>
                            <td>{{ $asset_in_service->date }}</td>
                            <td><a href="{{ route('asset-in-service',['id' => $asset_in_service->id]) }}" class="btn btn-xs flat btn-success">VIEW DETAILS</a></td>
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

            $('#assetInService').DataTable();
        });

    </script>
@endsection