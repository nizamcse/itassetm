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
            <form action="/?option=Asset" method="post">
                <input class="hide" type="text" name="AssTypid" value="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Asset Type Name</label>
                            <input type="text" class="form-control" name="txtAssetTypeName" value="" placeholder="Asset Type Name" required="">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Parent </label>
                            <select class="form-control select2" name="DPAssetParent" style="width: 100%" ;="">
                                <option value="">Top</option>
                                <option class="optionGroup" value="1">Software</option><option value="2">--Anti Virus</option><option class="optionGroup" value="3">Hardware</option><option value="4">--RAM</option>                </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="hide">
                        <div class="form-group">
                            <label>Asset Type Level</label>
                            <input class="hide" type="text" name="txtAssetLev" value="" placeholder="Asset Type Level">
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
                    <th>Asset Name</th>
                    <th>Asset Parent</th>
                    <th>Asset Level</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody><tr><td>1</td><td>Software</td><td>Top</td><td></td><td>
                        <a class="btn btn-success btn-xs" href="/?option=Asset&amp;code=1">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Asset&amp;Dcode=1&amp;delete=yes">Delete</a></td></tr><tr><td>2</td><td>Anti Virus</td><td>Software</td><td></td><td>
                        <a class="btn btn-success btn-xs" href="/?option=Asset&amp;code=2">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Asset&amp;Dcode=2&amp;delete=yes">Delete</a></td></tr><tr><td>3</td><td>Hardware</td><td>Top</td><td></td><td>
                        <a class="btn btn-success btn-xs" href="/?option=Asset&amp;code=3">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Asset&amp;Dcode=3&amp;delete=yes">Delete</a></td></tr><tr><td>4</td><td>RAM</td><td>Hardware</td><td></td><td>
                        <a class="btn btn-success btn-xs" href="/?option=Asset&amp;code=4">Edit</a>	| <a class="btn btn-danger btn-xs" href="/?option=Asset&amp;Dcode=4&amp;delete=yes">Delete</a></td></tr>                      </tbody><tbody>

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