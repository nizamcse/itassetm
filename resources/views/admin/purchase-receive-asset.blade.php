@extends('layouts.admin')

@section('content')
    <div class="box box-default" style="border-top: 0px !important;">
        <div class="box-header with-border">
            <h2 class="box-title text-center" style="display: block; font-size: 24px; margin:15px 0">Purchase Receive</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Asset Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($assets as $asset)
                    <tr>
                        <td>{{ $asset->name }}</td>
                        <td><a href="{{ route('get-receive-asset',['pur_req_id' => $purchase_req_id, 'asset_id' => $asset->id]) }}" class="btn btn-xs btn-flat btn-success">RECEIVE</a></td>
                        <td> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>
@endsection