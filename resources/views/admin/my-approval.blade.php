@extends('layouts.admin')

@section('content')
    <div class="box box-default" style="border-top: 0px !important;">
        <div class="box-header with-border">
            <h3 class="box-title">List of {{ $budget_types->first()->type_info == 'budget' ? 'budget type' : 'purchase requisition' }} you can approve.</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Budget Type</th>
                    <th>Current Status</th>
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
                                    @if($budget_type->employeesApproved->contains(Auth::user()->employee_id))
                                        <span class="label bg-green flat">Approved</span>
                                    @else
                                        <span class="label bg-blue flat">Not Approved</span>
                                    @endif
                                </a>
                            </td>
                            <td>
                                @if($budget_type->status == 0)
                                    <span class="label bg-red-gradient flat">Not Ready For Approval</span>
                                @elseif($budget_type->status == 1)
                                    <span class="label bg-blue flat">Rady To Approve</span>
                                @elseif($budget_type->status == 2)
                                    <span class="label bg-light-blue flat">Partially Approved</span>
                                @elseif($budget_type->status == 3)
                                    <span class="label bg-green flat">Approved</span>
                                @endif
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

@section('script')
@endsection