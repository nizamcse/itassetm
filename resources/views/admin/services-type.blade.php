@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create Service Type</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status" style="display: none"></div>
            <form id="serviceTypeForm" action="{{ route('post.service-type') }}" method="POST">
                {{ csrf_field() }}
            <table id="serviceFormTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><label>Service Type Name</label></th>
                    <th><label>Service Type</label></th>
                    <th>
                        <button id="addFormRow" class="btn btn-success btn-add" type="button">
                            <i class="glyphicon glyphicon-plus gs"></i>
                        </button>
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td><input class="form-control service_type_name" name="service_type[0][name]" type="text" placeholder="Service Name" /></td>
                    <td>
                        <select name="service_type[0][type]"  class="form-control service_type_type">
                            <option value="1">Internal</option>
                            <option value="2">External</option>
                        </select>
                    </td>
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
                            <button id="submitServiceType" class="btn btn-success btn-add" type="submit">
                                Save
                            </button>
                        </td>
                    </tr>
                </tfoot>

            </table>
            </form>
            <form id="serviceTypeEditForm" action="#" method="POST" style="display:none">
                {{ csrf_field() }}
                <table id="serviceEditFormTable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><label>Service Type Name</label></th>
                        <th><label>Service Type</label></th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td><input class="form-control service_type_name" name="name" type="text" placeholder="Service Name" /></td>
                        <td>
                            <select name="service_type"  class="form-control service_type_type">
                                <option value="1">Internal</option>
                                <option value="2">External</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="2">
                            <button type="button" class="btn btn-danger cancel-edit-form">Cancel</button>
                            <button id="submitServiceType" class="btn btn-success btn-add" type="submit">
                                Save
                            </button>
                        </td>
                    </tr>
                    </tfoot>

                </table>
            </form>
            <!-- /.row -->
        </div>
        <div class="x_content">

            <div id="serviceTypes"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">


        </div>
    </div>
@endsection

@section('script')
    @include('../partials.service-type-table')
    <script type="text/javascript">
        $(document).ready(function () {
            var rowCount = $('table#serviceFormTable >tbody:last >tr').length;
            if(rowCount == 1) {
                document.getElementsByClassName('btn-remove')[0].disabled = true;
            }

            var addRows = function () {
                var rowCount = $('table#serviceFormTable >tbody:last >tr').length;

                var controlForm = $('table#serviceFormTable>tbody');
                var currentEntry = '<tr>'+$('table#serviceFormTable>tbody>tr:last').html()+'</tr>';
                var newEntry = $(currentEntry).appendTo(controlForm);
                //newEntry.find('input').val('');
                newEntry.find('input.service_type_name').attr('name','service_type['+rowCount+'][name]');
                newEntry.find('select.service_type_type').attr('name','service_type['+rowCount+'][type]');
                //Remove the Data - as it is cloned from the above

                //Add the button
                rowCount = $('table#serviceFormTable >tbody:last >tr').length;
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
                var rowCount = $('table#serviceFormTable >tbody:last >tr').length;
                if(rowCount == 1) {
                    document.getElementsByClassName('btn-remove')[0].disabled = true;
                }

                e.preventDefault();
            });

            $( "#serviceTypeForm" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $( "#serviceTypeForm" )[0].reset();
                    //$( "#serviceTypeForm" ).css({"display":"none"});

                    $('table#serviceFormTable > tbody > tr:not(:first)').remove();

                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getServiceType();
                });
                event.preventDefault();
            });

            $( "#serviceTypeEditForm" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $( "#serviceTypeEditForm" )[0].reset();
                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    $("#submit-status").show().delay(1000).queue(function(n) {
                        $(this).hide().delay(1000);
                    });
                    getServiceType();
                    $("#serviceTypeEditForm").css({"display" : "none"});
                    $("#serviceTypeForm").css({"display" : "block"});
                });
                event.preventDefault();
            });

            var getServiceType = function () {
                $.ajax({url: "{{ route('json-service-type') }}", success: function(result){
                    serviceTypeData(result);
                }});
            };

            function serviceTypeData(data){

                Handlebars.registerHelper('ifExternal', function(a, options) {
                    if (a == 2) {
                        return options.fn(this);
                    }

                    return options.inverse(this);
                });

                Handlebars.registerHelper('ifInternal', function(a, options) {
                    if (a == 1) {
                        return options.fn(this);
                    }

                    return options.inverse(this);
                });

                var theTemplateScript = $("#servicce-type-data-template").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#serviceTypes').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#datatableN').DataTable();
            }


            $(document).on('click','.btn-delete',function (e) {
                console.log($(this));
                var url = "{{ route('json-delete-service-type') }}/"+$(this).data('id');

                $.ajax({
                    type        : 'GET',
                    url         : url,
                    encode      : true
                }).done(function(data) {
                    console.log(data);
                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getServiceType();
                });
            });
            $(document).on('click','.btn-edit',function (e) {
                var url = "{{ route('json-update-service-type') }}/"+$(this).data('id');
                $("#serviceTypeEditForm").attr("action",url);
                $("#serviceTypeEditForm").css({"display" : "block"});
                $("#serviceTypeForm").css({"display" : "none"});
                $("#serviceTypeEditForm input[name=name]").val($(this).data('name'));
                $('#serviceTypeEditForm select option[value="'+$(this).data('service-type')+'"]').prop('selected', true);
            });

            $(document).on('click','.cancel-edit-form',function (e) {
                $("#serviceTypeEditForm").css({"display" : "none"});
                $("#serviceTypeForm").css({"display" : "block"});
            });

            getServiceType();


        });

    </script>
@endsection