@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">REMAINING AND USED BUDGET DETAILS</h3>
        </div>

        @if(!count($yearly_budgets))
            <div class="box-body" style="border-radius: 0px">
                <h4 class="text-warning">Sorry! There is no yearly budget yet.</h4>
            </div>
        @else
            <div class="box-body" style="border-radius: 0px">
                <table class="table table-bordered table-striped showDatatable">
                    <thead>
                    <tr>
                        <th>BUDGET ID</th>
                        <th>BUDGET TYPE</th>
                        <th>BUDGET HEAD</th>
                        <th>USD AMOUNT</th>
                        <th>BDT AMOUNT</th>
                        <th>REMAINING AMOUNT(BDT)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($yearly_budgets as $yearly_budget)
                        <tr>
                            <td>{{ $yearly_budget->id }}</td>
                            <td>{{ $yearly_budget->budgetType->budget_type_name }}</td>
                            <td>{{ $yearly_budget->budgetHead->name }}</td>
                            <td>{{ $yearly_budget->usd_amount }}</td>
                            <td>{{ $yearly_budget->bdt_amount }}</td>
                            <td>{{ $yearly_budget->remainingBudget->Remaining_Balance }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            $('.showDatatable').DataTable();
        });

    </script>
@endsection