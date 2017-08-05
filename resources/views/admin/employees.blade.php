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
            <form action="/?option=Employe" method="post">
                <input class="hide" type="text" name="empid" value="">
                <div class="row">
                    <div class="col-xs-2">
                        <label>Employee Code</label>
                        <input type="text" class="form-control" name="txtEmpCode" value="" placeholder="Employee Code" required="">
                    </div>
                    <div class="col-xs-5">
                        <label>Employee Name</label>
                        <input type="text" class="form-control" name="txtEmpName" value="" placeholder="Employee Name" required="">
                    </div>
                    <div class="col-xs-3">
                        <label>Designation</label>
                        <input type="text" class="form-control" name="DpEmpDesignation" value="" placeholder="Designation">
                    </div>
                    <div class="col-xs-2">
                        <label>Joining Date</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="Employeedatepicker3" name="DTjoin" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="txtEmpPhone" value="" placeholder="Phone">
                    </div>
                    <div class="col-xs-3">
                        <label>Email</label>
                        <input type="text" class="form-control" name="txtEmpEmail" value="" placeholder="Email">
                    </div>
                    <div class="col-xs-2">
                        <label>Department</label>

                        <select class="form-control select2" name="DpEmpDepartment" style="width: 100%" ;="">
                            <option value=""> Choose department</option>
                            <option value="3">HR</option><option value="4">IT</option><option value="6">Accounts</option><option value="8">ytutyut</option>                </select>
                    </div>
                    <div class="col-xs-2">
                        <label>Section</label>
                        <select class="form-control select2" name="DpEmpSection" style="width: 100%" ;="">
                            <option value="">Choose Section</option>
                            <option value="1">sec1</option><option value="4">Sec2</option><option value="5">fgdfgdf</option>                </select>
                    </div>
                    <div class="col-xs-2">
                        <label>Location</label>
                        <select class="form-control select2" name="DpEmpLocation" ="width:="" 100%";="">
                        <option value="">Choose Location</option>
                        <option value="1">Uttara</option><option value="3">Building 1</option><option value="4">Gulshan</option><option value="6">Building 1</option><option value="7">Building 2</option><option value="8">room1</option><option value="9">room2</option><option value="14">Desk 1</option><option value="15">test</option><option value="16">ajimpur</option><option value="17">mogda</option><option value="18">test</option>                </select>
                    </div>
                </div>
            </form></div>

        <button type="submit" class="btn btn-success">Save</button>

        <!-- /.row -->
    </div>
    <div class="x_content">

        <table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID#</th>
                <th>Employee Name</th>
                <th>Designation</th>
                <th>Phone </th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody><tr><td>1</td><td>linkon</td><td>IT</td><td>019</td><td>@gmail.com</td><td>
                    <a class="btn btn-success btn-xs" href="/?option=Employe&amp;code=1">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Employe&amp;code=1&amp;delete=yes">Delete</a>							</td></tr><tr><td>3</td><td>nahid</td><td>na</td><td>01913800099</td><td>@gmail.com</td><td>
                    <a class="btn btn-success btn-xs" href="/?option=Employe&amp;code=3">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Employe&amp;code=3&amp;delete=yes">Delete</a>							</td></tr>						<!--<a class="btn btn-primary btn-xs" href="/?option=Department&code=">"Edit"</a>-->
            </tbody><tbody>

            </tbody>
        </table>
    </div>
    <div class="box-footer">

    </div>
@endsection