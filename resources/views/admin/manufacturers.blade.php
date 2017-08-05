@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Select2</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="/?option=Manufacturer" method="post">
                <input class="hide" type="text" name="Hideid" value="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Manufacturer Name</label>
                            <input type="text" class="form-control" name="txtManufacName" value="" placeholder="Manufacturer Name" required="">
                        </div>
                    </div>

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
                    <th>Manufacturer Name</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
        </div>
    </div>
@endsection