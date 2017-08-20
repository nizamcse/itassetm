@extends('layouts.admin')
@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Sub Asset Details</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form id="subAssetForm" action="#" method="post">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Old Code</label>
                            <input type="text" class="form-control" name="asset_old_code" value="" placeholder="Asset Old Code">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sub-Asset Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Asset Name">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Parent Asset</label>
                            <select name="parent_id" class="form-control select2" style="width: 100%" ;>
                                <option value="">Choose Parent Asset</option>
                                <option value="">Choose Parent Asset</option>
                                <option value="">Choose Parent Asset</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea type="text" class="form-control" name="short_description" placeholder="Description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Life Time</label>
                            <input type="text" class="form-control" name="life_time" value="" placeholder="Number">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Life Unit</label>
                            <select name="life_time_unit" class="form-control select2" style="width: 100%" ;>
                                <option value="0">Choose Life Unit</option>
                                <option value="1">Day</option>
                                <option value="2">Month</option>
                                <option value="3">Year</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Retainment Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="Employeedatepicker" name="retirement_date">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label></label>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.box-body -->
    <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID#</th>
                <th>Asset Code</th>
                <th>Asset Name</th>
                <th>Asset Type</th>
                <th>Asset Dept</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
    <div class="box-footer">

    </div>
@endsection

@section('script')
    @include('../partials.asset-list')
    <script>

        $(document).ready(function () {
        });

    </script>
@endsection