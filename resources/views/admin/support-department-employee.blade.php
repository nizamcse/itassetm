@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">SUPPORT DEPARTMENTS EMPLOYEE</h3>
            <div class="box-tools pull-right">
                <button data-toggle="modal" data-target="#supportDeptEmployeeCreate" id="addSupportDeptEmployee" type="button" class="btn btn-info btn-xs btn-flat">
                    <i class="fa fa-plus"></i>CREATE
                </button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="supportDeptDataTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><label>Department Name</label></th>
                    <th><label>User</label></th>
                    <th class="text-right"><label>Action</label></th>
                </tr>
                </thead>
                <tbody>
                @foreach($dept_employees as $depts)
                    @foreach($depts->users as $user)
                        <tr>
                            <td>{{ $depts->name }}</td>
                            <td>{{ $user->name }}</td>
                            <td class="text-right">
                                <a href="{{ route('remove-support-dept-employee',['id' => $depts->id,'user_id' => $user->id]) }}" class="btn btn-xs flat btn-danger btn-edit" type="button">REMOVE</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade flat" id="supportDeptEmployeeCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="create-dept-user" action="{{ route('support-department-employee') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">ASSIGN EMPLOYEE TO SUPPORT DEPARTMENT</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">SELECT DEPARTMENT</label>
                            <select name="department" id="department" class="form-control">
                                <option value="">- Select Department</option>
                                @foreach($dept_employees as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">SELECT USERS</label>
                            <select name="user" id="user" class="form-control">
                                <option value="">Select Employee</option>
                            </select>
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
            $("form#create-dept-user select[name='department']").change(function () {
                var dept_id = $(this).val();
                var url = "{{ route('get-support-dept-assignable-user') }}/"+dept_id;
                $.ajax({url: url, success: function(result){
                    console.log(result);
                    $("#create-dept-user select[name='user']").html(result);
                }});
            });

            $('#supportDeptDataTable').DataTable();
        });

    </script>
@endsection