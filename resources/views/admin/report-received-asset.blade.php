@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">RECEIVED ASSETS</h3>
        </div>

        @if(!count($purchase_requisitions))
            <div class="box-body" style="border-radius: 0px">
                <h4 class="text-warning">Sorry! There is no asset received yet.</h4>
            </div>
        @endif

        <div class="box-body" style="border-radius: 0px">
            @foreach($purchase_requisitions as $purchase_requisition)
                <div class="widget-wraper">
                    <div class="widget-title">
                        <h3>{{ $purchase_requisition->particulars }}</h3>
                        <p><stront>REQUISITION NO : </stront>{{ $purchase_requisition->id }}</p>
                    </div>
                    <div class="widget-body">
                        <table class="table table-bordered table-striped showDatatable">
                            <thead>
                            <tr>
                                <th>ASSET ID</th>
                                <th>ASSET NAME</th>
                                <th>REQUISITION QTY</th>
                                <th>RECEIVED QTY</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchase_requisition->purchaseRequisitionDetails as $pr_details)
                                <tr>
                                    <td>{{ $pr_details->asset->id }}</td>
                                    <td>{{ $pr_details->asset->name }}</td>
                                    <td>{{ $pr_details->asset->vwReceiveDetail ? $pr_details->asset->vwReceiveDetail->REQ_QTY : $pr_details->quantity }}</td>
                                    <td>{{ $pr_details->asset->vwReceiveDetail ? $pr_details->asset->vwReceiveDetail->Receive_QTY : 0 }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
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