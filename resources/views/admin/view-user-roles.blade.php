@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">{{ $user->name }}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <form action="{{ route('update-user-roles',['id' => $user->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    @foreach($roles as $role)
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input name="roles[]" type="checkbox" value="{{ $role->id }}" {{ $role->users->contains($user->id) ? 'checked' : '' }}>
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group">
                    <button class="flat btn btn-info btn-xs" type="submit" disabled>UPDATE</button>
                </div>
            </form>
        </div>
        <!-- /.row -->
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {
            $("input[type='checkbox']").change(function () {
                $("button[type='submit']").removeAttr('disabled');
            });
        });

    </script>
@endsection