@extends('layouts.admin')

@section('content')
    <div class="box box-default" style="border-top: 0px !important;">
        <div class="box-header with-border">
            <h2 class="box-title text-center" style="display: block; font-size: 24px; margin:15px 0">Purchase Receive</h2>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Purchase Requisition</th>
                    <th>Particulars</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pur_reqns as $pur_reqn)
                    <tr>
                        <td><a href="{{ route('asset-receive',['id'  => $pur_reqn->id]) }}">{{ $pur_reqn->id.$pur_reqn->budgetType->budget_type_name }}</a></td>
                        <td>{{ $pur_reqn->particulars }}</td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
        });
    </script>
@endsection