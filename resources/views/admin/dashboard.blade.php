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
            <form action="/?option=Department" method="post">
                <input class="hide" type="text" name="deptid" value="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Department Name</label>
                            <input type="text" class="form-control" name="txtDepartmentName" value="" placeholder="Department" required="">

                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Reporting To </label>


                            <select name="DPReportingTo" class="form-control select2" style="width: 100%" ;="">

                                <option value="">Choose Reporting to</option>
                                <option value="1">linkon</option><option value="3">nahid</option>                </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <button type="submit" class="btn btn-success">Save</button>
            </form>
        </div>
        <div class="x_content">

            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID#</th>
                    <th>Department</th>
                    <th>Reporting To</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody><tr><td>3</td><td>HR</td><td>linkon</td><td>
                        <a class="btn btn-success btn-xs" href="/busSeat?option=Department&amp;code=3">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Department&amp;Dcode=3&amp;delete=yes">Delete</a>							</td></tr><tr><td>6</td><td>Accounts</td><td>nahid</td><td>
                        <a class="btn btn-success btn-xs" href="/busSeat?option=Department&amp;code=6">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Department&amp;Dcode=6&amp;delete=yes">Delete</a>							</td></tr><tr><td>4</td><td>IT</td><td></td><td>
                        <a class="btn btn-success btn-xs" href="/busSeat?option=Department&amp;code=4">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Department&amp;Dcode=4&amp;delete=yes">Delete</a>							</td></tr><tr><td>8</td><td>ytutyut</td><td></td><td>
                        <a class="btn btn-success btn-xs" href="/busSeat?option=Department&amp;code=8">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Department&amp;Dcode=8&amp;delete=yes">Delete</a>							</td></tr>						<!--<a class="btn btn-primary btn-xs" href="/?option=Department&code=OA==">"Edit"</a>-->
                </tbody><tbody>

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
    </div>
@endsection