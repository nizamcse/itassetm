@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">SUPPORT DEPARTMENTS</h3>
            <div class="box-tools pull-right">
                <button data-toggle="modal" data-target="#supportDeptCreate" id="addSupportDept" type="button" class="btn btn-info btn-xs btn-flat">
                    <i class="fa fa-plus"></i>CREATE SUPPORT DEPARTMENT
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="vendorFormTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><label>ID</label></th>
                    <th><label>Department Name</label></th>
                    <th><label>Action</label></th>
                </tr>
                </thead>
                <tbody>
                @foreach($support_depts as $support_dept)
                    <tr>
                        <td>{{ $support_dept->id }}</td>
                        <td>{{ $support_dept->name }}</td>
                        <td>
                            <button class="btn flat btn-warning btn-edit btn-xs" type="button" data-id="{{ $support_dept->id }}" data-name="{{ $support_dept->name }}" data-toggle="modal" data-target="#supportDeptEdit">EDIT</button>
                            <a href="{{ route('delete-support-dept',['id' => $support_dept->id]) }}" class="btn btn-xs flat btn-danger btn-edit" type="button">DELETE</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade flat" id="supportDeptCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('create-support-dept') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">CREATE SUPPORT DEPARTMENT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Support Department Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-xs flat" data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary btn-xs flat">CREATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade flat" id="supportDeptEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="updateSupportDept" action="#" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">CREATE SUPPORT DEPARTMENT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Support Department Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-xs flat" data-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-primary btn-xs flat">CREATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>

        $(document).ready(function () {
            $(".btn-edit").click(function () {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var url = "{{ route('update-support-dept') }}/"+id;

                $("#updateSupportDept").attr({
                    "action" : url
                });

                $("#updateSupportDept input[name='name']").val(name);
            });
        });

    </script>
@endsection