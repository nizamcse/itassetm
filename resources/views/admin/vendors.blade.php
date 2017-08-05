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
            <form action="/?option=Vendor" method="post">
                <input class="hide" type="text" name="txtHide" value="">
                <div class="row">
                    <div class="col-xs-3">
                        <label>Vendor Name</label>
                        <input type="text" class="form-control" name="txtVenName" value="" placeholder="Employee Name" required="">
                    </div>
                    <div class="col-xs-3">
                        <label>Contact Person</label>
                        <input type="text" class="form-control" name="DPContact" value="" placeholder="Employee Name" required="">
                    </div>
                    <div class="col-xs-3">
                        <label>Contact No</label>
                        <input type="text" class="form-control" name="txtVenConNo" value="" placeholder="Contact Person">
                    </div>
                    <div class="col-xs-3">
                        <label>Address</label>
                        <textarea type="text" class="form-control" name="txtVenAdd" placeholder="Designation"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-3">
                        <label>Web Address</label>
                        <input type="text" class="form-control" name="txtVenWeb" value="" placeholder="Phone">
                    </div>
                    <div class="col-xs-3">
                        <label>Trade No</label>
                        <input type="text" class="form-control" name="txtVenTrade" value="" placeholder="Email">
                    </div>
                    <div class="col-xs-3">
                        <label>Vat No</label>
                        <input type="text" class="form-control" name="txtVenVat" value="" placeholder="Email">

                    </div>
                    <div class="col-xs-3">
                        <label>Company Name</label>
                        <input type="text" class="form-control" name="txtCompanyName" value="" placeholder="Email">


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
                <th>Vendor Name</th>
                <th>Contact Person</th>
                <th>Phone </th>
                <th>Web Address</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody><tr><td>2</td><td>ABC</td><td>Sarif</td><td>01912222</td><td>ssaa@</td><td>
                    <a class="btn btn-success btn-xs" href="/?option=Vendor&amp;code=2">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Vendor&amp;code=2&amp;delete=yes">Delete</a>							</td></tr>						<!--<a class="btn btn-primary btn-xs" href="/?option=Department&code=">"Edit"</a>-->
            </tbody><tbody>

            </tbody>
        </table>
    </div>
    <div class="box-footer">

    </div>
@endsection