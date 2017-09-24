@extends('layouts.admin')

@section('content')
    @if(count($purchase_requisition->purchaseRequisitionDetails))
        <div class="box box-default" style="border-top: 0px !important;">
            <div class="box-header with-border">
                <h2 class="box-title text-center" style="display: block; font-size: 24px; margin:25px 0">{{ $budget_type->budget_type_name }}</h2>
                <div class="text-success" style="margin-top: 30px;">
                    <h5>PARTICULARS: {{ $purchase_requisition->particulars }}</h5>
                    <p>APPROXIMATE AMOUNT: {{ $purchase_requisition->purchaseRequisitionDetails->pluck('approx_price')->sum() }}</p>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="text-right">
                    @if($purchase_requisition->status && $purchase_requisition->status<3)
                        @if($budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order - 1 == count($purchase_requisition->employeesApprovedAlready))
                            <a href="{{ route('approve-pr',['id' => $purchase_requisition->id]) }}" class="btn btn-info btn-xs btn-flat">APPROVE</a>
                            <a href="{{ route('cancel-approved-pr',['id' => $purchase_requisition->id]) }}" class="btn btn-danger btn-xs btn-flat">CANCEL ALL APPROVAL</a>
                        @elseif($purchase_requisition->employeesApprovedAlready->contains(Auth::user()->employee_id) && $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($purchase_requisition->employeesApprovedAlready))
                            <a href="{{ route('cancel-approved-pr',['id' => $purchase_requisition->id]) }}" class="btn btn-danger btn-xs btn-flat">CANCEL ALL APPROVAL</a>
                        @endif
                    @endif

                </div>
                <table class="table table-striped table-bordered dataTable">
                    <thead>
                    <tr>
                        <th>ID#</th>
                        <th>Asset</th>
                        <th>Employee</th>
                        <th>Manufacturer</th>
                        <th>Quantity</th>
                        <th style="padding-right: 0px;min-width: 120px;" class="text-right">Approximate Price</th>
                        @if($purchase_requisition->status && $purchase_requisition->status<3)
                            @if( $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($purchase_requisition->employeesApprovedAlready) || $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($purchase_requisition->employeesApprovedAlready)+1 )
                                <th>
                                    Comment
                                </th>
                            @endif
                        @endif

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($purchase_requisition->purchaseRequisitionDetails as $purchaseRequisitionDetail)
                        <tr>
                            <td>{{ $purchaseRequisitionDetail->id }}</td>
                            <td>{{ $purchaseRequisitionDetail->asset->name }}</td>
                            <td>{{ $purchaseRequisitionDetail->asset->employee->name }}</td>
                            <td>{{ $purchaseRequisitionDetail->asset->manuFacturer->name }}</td>
                            <td>{{ $purchaseRequisitionDetail->quantity }}</td>
                            <td class="text-right">{{ $purchaseRequisitionDetail->approx_price }}</td>
                            @if($purchase_requisition->status && $purchase_requisition->status<3)
                                @if( $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($purchase_requisition->employeesApprovedAlready) || $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($purchase_requisition->employeesApprovedAlready)+1 )
                                    <td>
                                        <a href="#" data-id="{{ $purchaseRequisitionDetail->id }}" data-toggle="modal" data-target="#modificationModal" class="btn-modification-note btn btn-xs btn-flat btn-warning">Remark</a>
                                    </td>
                                @endif
                            @endif

                        </tr>
                        @if($purchaseRequisitionDetail->comment)
                            <tr>
                                <td colspan="8" class="text-danger">{{ $purchaseRequisitionDetail->comment }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <div class="modal fade" id="modificationModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">WRITE DOWN MODIFICATION NOTE</h4>
                </div>
                <div class="modal-body">
                    <form id="notification-note-form" action="#" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea name="comment" id="comment" cols="30" rows="6" class="form-control" placeholder="Your comment here"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary btn-flat">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($budget_type->status && $budget_type->status<3)
        @if( $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_type->employeesApproved) || $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_type->employeesApproved)+1 )
            <div class="modal fade" id="modificationModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">WRITE DOWN MODIFICATION NOTE</h4>
                        </div>
                        <div class="modal-body">
                            <form id="notification-note-form" action="#" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea name="comment" id="comment" cols="30" rows="6" class="form-control" placeholder="Your comment here"></textarea>
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-flat">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".btn-modification-note").click(function (event) {
                var url = "{{ route('budget-modification',['id' => $budget_type->id]) }}" +'/'+$(this).data('id');
                $("#notification-note-form").attr('action',url);
            });
        });
    </script>
@endsection