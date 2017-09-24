@extends('layouts.admin')

@section('content')
    @if(count($budget_types))
        <div class="box box-default" style="border-top: 0px !important;">
        <div class="box-header with-border">
            <h3 class="box-title">List of budget you can approve.</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Budget Type</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($budget_types as $budget_type)
                    @if(count($budget_type->employees))

                        <tr>
                            <td>{{ $budget_type->id }}</td>
                            <td>
                                <a href="{{ $budget_types->first()->type_info == 'budget' ? route('my-budget-approval-details',['id' => $budget_type->id]) : route('my-purchase-req-approval-details',['id' => $budget_type->id]) }}">
                                    {{ $budget_type->budget_type_name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('send-to-approve',['id' => $budget_type->id]) }}" class="btn btn-xs btn-flat btn-info">SEND FOR APROVAL</a>
                                <a href="#" class="btn btn-xs btn-flat btn-danger">DELETE</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    @endif

    @if(count($purchase_req))
        <div class="box box-default" style="border-top: 0px !important;">
            <div class="box-header with-border">
                <h3 class="box-title">List of purchase requisition you can approve.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Particulars</th>
                        <th>Purchase Requisition Type</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($purchase_req as $purchase_reqn)
                        <tr>
                            <td>{{ $purchase_reqn->id }}</td>
                            <td>
                                <a href="{{ route('pr-details',['id' => $purchase_reqn->id]) }}">
                                    {{ $purchase_reqn->particulars }}
                                </a>
                            </td>
                            <td>
                                {{ $purchase_reqn->budgetType->budget_type_name }}
                            </td>
                            <td>
                                {{ $purchase_reqn->date }}
                            </td>
                            <td>
                                <a href="{{ route('send-pr-to-approve',['id' => $purchase_reqn->id]) }}" class="btn btn-xs btn-flat btn-info">SEND FOR APROVAL</a>
                                <a href="#" class="btn btn-xs btn-flat btn-danger">DELETE</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    @endif

    @if(!count($budget_types) && !count($purchase_req))
        <div class="box box-default" style="border-top: 0px !important;">
            <div class="box-header with-border">
                <h3 class="box-title">There is no budget or purchase requisition to send for approval.</h3>
            </div>
        </div>
    @endif

@endsection

@section('script')
@endsection