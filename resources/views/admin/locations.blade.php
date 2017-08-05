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
            <form action="{{ route('post.location') }}" method="POST">
                {{ csrf_field() }}
                <input class="hide" type="text" name="Locid" value="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Location Name</label>
                            <input type="text" class="form-control" name="name" value="" placeholder="Location Name" required="">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Parent </label>

                            <select class="form-control select2" name="parent_id" style="width: 100%;">
                                <option value="">Top</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="hide">
                        <div class="form-group">
                            <label>Location Level</label>
                            <input type="text" class="form-control" name="txtLocationLev" value="" placeholder="Location Level">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Save</button>
            </form>
            <!-- /.row -->
        </div>
        <div class="x_content">
            <div id="locations"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Visit <a href="https://select2.github.io/">Select2 documentation</a> for more examples and information about
            the plugin.
        </div>
    </div>
@endsection

@section('script')
    @include('../partials.location-list')
    <script>
        var locationData = function (data) {

            var theTemplateScript = $("#location-data-template").html();

            // Compile the template
            console.log(data);
            var theTemplate = Handlebars.compile(theTemplateScript);


            // Pass our data to the template
            var theCompiledHtml = theTemplate(data);
            // Add the compiled html to the page
            $('#locations').html(theCompiledHtml);

        };

        var locations = function (){
            $.ajax({url: "{{ route('json-location') }}", success: function(result){
                locationData(result);
            }});
        }

        locations();


    </script>
@endsection