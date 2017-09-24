@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">CREATE ISSUED ITEM DOCUMENTATION</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            @if(count($issue_details_assets))
                <form action="{{ route('create-issued-item-docs') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="issued_item_id">SELECT ASSET</label>
                            <select name="issued_item_id" id="issued_item_id" class="form-control">
                                <option value="">- Select Asset</option>
                                @foreach($issue_details_assets as $issue_details_asset)
                                    <option value="{{ $issue_details_asset->id }}">{{ $issue_details_asset->asset->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="docs">Documentation</label>
                            <textarea class="form-control" name="docs" id="docs" cols="30" rows="10"></textarea>
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
            @else
                <p class="text-warning">Sorry! There is no issued item to create documentation.</p>
            @endif
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