@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">SEND TO SERVICE</h3>
            <p class="text-warning">{{ isset($message) ? $message : '' }}</p>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <div id="submit-status"></div>
            <form id="sendToService" action="{{ route('send-for-service') }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Vendor</label>
                            <select name="vendor" id="vendor" class="form-control" required>
                                <option value="">Select Vendor</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Service Type</label>
                            <select name="service_type" id="service_type" class="form-control" required>
                                <option value="">Select Service Type</option>
                                @foreach($service_types as $service_type)
                                    <option value="{{ $service_type->id }}">{{ $service_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="box-header">
                    <h3 class="box-title">SELECT ASSET TO SEND FOR SERVICE</h3>
                </div>
                <table id="sendToServiceTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><label>Asset</label></th>
                        <th><label>Problem Description</label></th>
                        <th><label>Remarks</label></th>
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
                            <select name="asset[0][name]" id="" class="form-control asset-name" required>
                                <option value="">- Select Asset</option>
                                @foreach($issued_assets as $issued_asset)
                                    @if($issued_asset->asset)
                                        <option value="{{ $issued_asset->asset->id }}">{{ $issued_asset->asset->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td><input class="form-control asset-problem" name="asset[0][problem]" type="text" placeholder="Problem" required></td>
                        <td><input class="form-control asset-sd_remarks" name="asset[0][sd_remarks]" type="text" placeholder="Remarks"></td>
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
@endsection

@section('script')
    <script>

        $(document).ready(function () {
            var rowCount = $('table#sendToServiceTable >tbody:last >tr').length;

            if(rowCount == 1) {
                document.getElementsByClassName('btn-remove')[0].disabled = true;
            }
            var addRows = function () {
                var rowCount = $('table#sendToServiceTable >tbody:last >tr').length;

                var controlForm = $('table#sendToServiceTable>tbody');
                var currentEntry = '<tr>'+$('table#sendToServiceTable>tbody>tr:last').html()+'</tr>';
                var newEntry = $(currentEntry).appendTo(controlForm);

                newEntry.find('select.asset-name').attr('name','asset['+rowCount+'][name]');
                newEntry.find('input.asset-problem').attr('name','asset['+rowCount+'][peoblem]');
                newEntry.find('input.asset-sd_remarks').attr('name','asset['+rowCount+'][sd_remarks]');

                rowCount = $('table#sendToServiceTable >tbody:last >tr').length;
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
                var rowCount = $('table#sendToServiceTable >tbody:last >tr').length;
                if(rowCount == 1) {
                    document.getElementsByClassName('btn-remove')[0].disabled = true;
                }

                e.preventDefault();
            });
        });

    </script>
@endsection