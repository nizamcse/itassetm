@extends('layouts.admin')

@section('content')
    <div class="box box-default" style="border-top: 0px !important;">
        <div class="box-header with-border">
            <h3 class="box-title">List of purchase requisition you can approve</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table class="table table-striped table-bordered dataTable">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Particulars</th>
                    <th>Requisition Type</th>
                    <th>Current Status</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($pr_reqns as $pr_reqn)
                        <tr>
                            <td>{{ $pr_reqn->id }}</td>
                            <td>
                                <a href="{{ route('my-purchase-req-approval-details',['id' => $pr_reqn->id]) }}">
                                    {{ $pr_reqn->particulars }}
                                </a>
                            </td>
                            <td>{{ $pr_reqn->budgetType->budget_type_name }}</td>
                            <td>
                                @if($pr_reqn->status == 3)
                                    <p class="text-success">
                                        Approved
                                        @if($pr_reqn->employeesApprovedAlready->contains(Auth::user()->employee_id))
                                            <em class="text-success">[ You Approved This ]</em>
                                        @endif
                                    </p>
                                @elseif($pr_reqn->status == 2)
                                    <p class="text-info">
                                        Approved by {{ count($pr_reqn->employeesApprovedAlready) }} employee
                                        @if($pr_reqn->employeesApprovedAlready->contains(Auth::user()->employee_id))
                                            <em class="text-success">[ You Approved This ]</em>
                                        @endif
                                    </p>
                                @elseif($pr_reqn->status == 1)
                                    <p class="text-info">
                                        Ready To Approve
                                    </p>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

@section('script')
@endsection