@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">AUTHORIZATION ROLES</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table id="vendorFormTable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th><label>ID</label></th>
                    <th><label>Role</label></th>
                    <th><label>Description</label></th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
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