@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">PURCHASE REQUISITIONS</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            @if(!count($purchase_requisitions))
                <p class="text-danger">No purchase requisition found.</p>
            @else
                <table class="table table-hover table bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Purchase Requisition</th>
                    <th>Particulars</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchase_requisitions as $purchase_requisition)
                    <tr>
                        <td>{{ $purchase_requisition->id }}</td>
                        <td>
                            <a href="{{ route('pr-details',['id' => $purchase_requisition->id]) }}">
                                {{ $purchase_requisition->budgetType->budget_type_name }}
                            </a>
                        </td>
                        <td>{{ $purchase_requisition->particulars }}</td>
                        <td>
                            @if(count($purchase_requisition->receives) == 0 && Auth::user()->user_type == 'ADMIN')
                                <a href="{{ route('delete-purchase-requisition',['id' => $purchase_requisition->id]) }}">DELETE</a>
                            @endif

                            @if(count($purchase_requisition->receives) == 0 && Auth::user()->user_type == 'ADMIN' && ($purchase_requisition->status >0 && $purchase_requisition->status <3 ))
                                <a href="{{ route('force-approve-purchase-requisition',['id' => $purchase_requisition->id]) }}">FORCE APPROVE</a>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('script')
    <script>
    </script>
@endsection