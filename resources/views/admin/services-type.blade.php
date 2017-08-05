@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="/?option=Service_Type" method="post">
                <input class="hide" type="text" name="secid" value="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service Name</label>
                            <input type="text" class="form-control" name="txtSvrName" value="" placeholder="Section Name" required="">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Service Type</label>

                            <select name="DPSvrType" class="form-control select2" style="width: 100%" ;="">
                                <option value="0">Choose Service Type</option>
                                <option value="1">External</option>
                                <option value="2">Internal</option>

                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
            <!-- /.row -->
        </div>
        <div class="x_content">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Service Name</th>
                    <th>Service Type</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">


        </div>
    </div>
@endsection