@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">USER LIST</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="vendorFormTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><label>ID</label></th>
                    <th><label>Name</label></th>
                    <th><label>Email</label></th>
                    <th><label>User Type</label></th>
                    <th><label>Action</label></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_type }}</td>
                        <td><a href="{{ route('user-roles',['id' => $user->id]) }}" class="btn flat btn-info btn-xs">VIEW ROLE</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {
        });

    </script>
@endsection