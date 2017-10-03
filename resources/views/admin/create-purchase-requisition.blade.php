@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">PURCHASE REQUISITION</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <div id="submit-status"></div>
            <form id="purchaseReqForm" action="{{ route('purchase-requisition') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Purchase Req Type</label>
                            <select name="budget_type" id="budget_type" class="form-control" required>
                                <option value="">Select Purchase Req Type</option>
                                @foreach($budget_types as $budget_type)
                                    <option value="{{ $budget_type->id }}">
                                        {{ $budget_type->budget_type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Particulars</label>
                            <input type="text" name="particulars" class="form-control" style="text-transform: uppercase">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date</label>
                            <input name="date" class="form-control datepicker">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Expect To Receive</label>
                            <input name="expected_receive_date" class="datepicker form-control">
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">PURCHASE REQUISITION DETAILS</h3>
                </div>
                <table id="vendorFormTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><label>Asset</label></th>
                        <th><label>Quantity</label></th>
                        <th><label>Approximate Price</label></th>
                        <th>
                            <button id="addFormRow" class="btn btn-success btn-add" type="button">
                                <i class="glyphicon glyphicon-plus gs"></i>
                            </button>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            <select name="asset[0][name]" id="" class="form-control asset-name">
                                <option value="">- Select Asset</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->name }}, Employee - {{ $asset->employee->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input class="form-control asset-quantity" name="asset[0][quantity]" type="text" placeholder="Quantity" /></td>
                        <td><input class="form-control asset-price" name="asset[0][price]" type="text" placeholder="Approximate Price" /></td>
                        <td>
                            <button class="btn btn-danger btn-remove" type="button">
                                <i class="glyphicon glyphicon-minus gs"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <button type="submit" id="savePurchaseReq" class="btn btn-success">Save</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
        <!-- /.row -->
    </div>

    <!-- /.box-body -->
    <div class="x_content">
        <div id="purchase-requisitions"></div>
    </div>
@endsection

@section('script')
    @include('../partials.purchase-requisition')
    <script>

        $(document).ready(function () {
            var rowCount = $('table#vendorFormTable >tbody:last >tr').length;

            if(rowCount == 1) {
                document.getElementsByClassName('btn-remove')[0].disabled = true;
            }
            var addRows = function () {
                var rowCount = $('table#vendorFormTable >tbody:last >tr').length;

                var controlForm = $('table#vendorFormTable>tbody');
                var currentEntry = '<tr>'+$('table#vendorFormTable>tbody>tr:last').html()+'</tr>';
                var newEntry = $(currentEntry).appendTo(controlForm);

                newEntry.find('select.asset-name').attr('name','asset['+rowCount+'][name]');
                newEntry.find('input.asset-quantity').attr('name','asset['+rowCount+'][quantity]');
                newEntry.find('input.asset-price').attr('name','asset['+rowCount+'][price]');

                rowCount = $('table#vendorFormTable >tbody:last >tr').length;
                if(rowCount > 1) {
                    var removeButtons = document.getElementsByClassName('btn-remove');
                    for(var i = 0; i < removeButtons.length; i++) {
                        removeButtons.item(i).disabled = false;
                    }
                }
            };

            $("#addFormRow").click(function (e) {
                e.preventDefault();
                addRows();
            });

            $(document).on('click','.btn-remove',function (e) {
                $(this).parents('tr:first').remove();

                //Disable the Remove Button
                var rowCount = $('table#vendorFormTable >tbody:last >tr').length;
                if(rowCount == 1) {
                    document.getElementsByClassName('btn-remove')[0].disabled = true;
                }

                e.preventDefault();
            });

            $('.datepicker').datepicker();
        });

    </script>
@endsection