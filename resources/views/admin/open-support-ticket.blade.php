@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">OPEN SUPPORT TICKET</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <form action="{{ route('create-support-ticket') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="department">SELECT DEPARTMENT</label>
                            <select name="department" id="department" class="form-control" required>
                                <option value="">- Select Deaprtment</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question">Quesion</label>
                            <textarea class="form-control" name="question" id="question" cols="30" rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="document">Upload File</label>
                            <input type="file" name="document" class="form-control">
                        </div>
                        <div class="form-group text-right">
                            <button class="btn flat btn-sm btn-info" type="submit">SAVE</button>
                        </div>
                    </div>
                </div>
            </form>
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