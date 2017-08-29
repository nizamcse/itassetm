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
@endsection

@section('script')
@endsection