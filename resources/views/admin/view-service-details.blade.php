@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">ASSET IN SERVICE</h3>
            <div class="box-tools pull-right">
                <a id="receveAll" href="{{ route('receive-all-from-service',['id' => $service_details->id]) }}" type="button" class="btn btn-info btn-xs flat"><i class="fa fa-plus"></i>RECEIVE ALL</a>
                <button id="receveSelected" type="button" class="btn btn-info btn-xs flat"><i class="fa fa-plus"></i>RECEIVE SELECTED</button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <form id="inServiceAsset" action="{{ route('receive-selected-from-service') }}" method="post">
                {{ csrf_field() }}
                <table id="assetInService" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Select</th>
                        <th>Asset ID</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($service_details->ExistsServiceDetails as $details)
                        <tr>
                            <td><input type="checkbox" name="asset[]" value="{{ $details->id }}"></td>
                            <td>{{ $details->asset->id }}</td>
                            <td>{{ $details->asset->name }}</td>
                            <td>
                                <a href="{{ route('receive-from-service',['id' => $details->id]) }}" class="btn btn-success flat btn-xs">RECEIVE</a>
                                <a href="{{ route('asset-log',['id' => $details->asset->id]) }}" class="btn btn-info flat btn-xs">VIEW LOG</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            $('#assetInService').DataTable();

            $( "#receveSelected" ).click(function() {
                var test = $("input[name='asset[]']:checked").length;
                if(test > 0){
                    $("#inServiceAsset" ).submit();
                }
            });
        });

    </script>
@endsection