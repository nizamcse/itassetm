@extends('layouts.admin')

@section('content')
    <div class="box box-default" style="border-top: 0px !important;">
        <div class="box-header with-border">
            <h2 class="box-title text-center" style="display: block; font-size: 24px; margin:25px 0">{{ $budget_types->budget_type_name }}</h2>
            <div class="text-success" style="margin-top: 30px;">
                <h4>USD AMOUNT: {{ $usd }}</h4>
                <h4>BDT AMOUNT: {{ $bdt }}</h4>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if($budget_types->status && $budget_types->status<3)
                <div class="text-right">
                    @if($budget_types->employees->find(Auth::user()->employee_id)->pivot->employee_order - 1 == count($budget_types->employeesApprovedAlready))
                        <a href="{{ route('approve-budget',['id' => $budget_types->id]) }}" class="btn btn-info btn-xs btn-flat">APPROVE</a>
                        <a href="{{ route('cancel-approved-budget',['id' => $budget_types->id]) }}" class="btn btn-danger btn-xs btn-flat">CANCEL ALL APPROVAL</a>
                    @elseif($budget_types->employeesApproved->contains(Auth::user()->employee_id) && $budget_types->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_types->employeesApproved))
                        <a href="{{ route('cancel-approved-budget',['id' => $budget_types->id]) }}" class="btn btn-danger btn-xs btn-flat">CANCEL ALL APPROVAL</a>
                    @endif
                </div>
            @endif
            <table class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Budget Head</th>
                    <th>Manufacturer</th>
                    <th>Budget Particulars</th>
                    <th style="padding-right: 0px" class="text-right">USD Ammount</th>
                    <th style="padding-right: 0px" class="text-right">BDT Amount</th>
                    <th style="padding-right: 0px" class="text-right">Quantity</th>
                    <th style="padding-right: 0px" class="text-right">Comment</th>
                </tr>
                </thead>

                <tbody>
                @foreach($details_data as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->budgetHead->name }}</td>
                        <td>{{ $data->manufacturer->name }}</td>
                        <td>{{ $data->budget_particulars }}</td>
                        <td class="text-right">{{ $data->usd_amount }}</td>
                        <td class="text-right">{{ $data->bdt_amount }}</td>
                        <td class="text-right">{{ $data->quantity }}</td>
                        <td class="text-right">
                            @if($budget_types->status && $budget_types->status<3)
                                @if( $budget_types->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_types->employeesApproved) || $budget_types->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_types->employeesApproved)+1 )
                                    <a href="#" data-id="{{ $data->id }}" data-toggle="modal" data-target="#modificationModal" class="btn-modification-note btn btn-xs btn-flat btn-warning">Remark</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @if($data->comment)
                        <tr>
                            <td colspan="8" class="text-danger">{{ $data->comment }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    @if($budget_types->status && $budget_types->status<3)
        @if( $budget_types->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_types->employeesApproved) || $budget_types->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_types->employeesApproved)+1 )
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
                var url = "{{ route('budget-modification',['id' => $budget_types->id]) }}" +'/'+$(this).data('id');
                $("#notification-note-form").attr('action',url);
            });
        });
    </script>
@endsection