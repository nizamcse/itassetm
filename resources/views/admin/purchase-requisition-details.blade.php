@extends('layouts.admin')
@section('content')
    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title">PURCHASE REQUISITION</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body" style="border-radius: 0px">
            <table class="table table-bored table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Purchase Requisition</th>
                    <th>Particulars</th>
                    @if($purchase_equisition->status == 0 || $purchase_equisition->status == 1)
                        <th class="text-right">Action</th>
                    @else
                        <th class="text-right">Status</th>
                    @endif

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $purchase_equisition->id }}</td>
                    <td>{{ $purchase_equisition->budgetType->budget_type_name }}</td>
                    <td>{{ $purchase_equisition->particulars }}</td>
                    <td class="text-right">
                        @if($purchase_equisition->status == 0)
                            <a href="{{ route('send-pr-to-approve',['id' => $purchase_equisition->id]) }}" class="btn flat btn-xs btn-success">SEND FOR APPROVAL</a>
                        @elseif($purchase_equisition->status == 1)
                            <a href="{{ route('cancel-approved-pr',['id' => $purchase_equisition->id]) }}" class="btn flat btn-xs btn-warning">REMOVE FROM APPROVAL</a>
                        @endif

                        @if($purchase_equisition->status == 0 || $purchase_equisition->status == 1)
                            <a href="#" class="btn flat btn-xs btn-info">Edit</a>
                            <a href="#" class="btn flat btn-xs btn-danger">Delete</a>
                        @else
                            @if($purchase_equisition->status == 3)
                                    <span class="text-info">Approved</span>
                            @else
                                <span class="text-info">Partially Approved</span>
                            @endif
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>

    <div class="box box-default" style="border-top: 0px; padding-top: 30px; border-radius: 0px">
        <div class="box-header">
            <h3 class="box-title" style="display: block">
                PURCHASE REQUISITION DETAILS
                @if($purchase_equisition->status == 0 || $purchase_equisition->status == 1)
                    <a href="#" class="btn pull-right flat btn-info btn-xs" data-toggle="modal" data-target="#addPrDetails">ADD NEW ASSET</a>
                @endif
            </h3>
        </div>
        <div class="box-body">
            <div id="purReqDetails"></div>
        </div>
        <!-- /.row -->
    </div>

    <div class="modal fade" id="editPrDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="pr-detail-edit" action="#">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit Purchase Requisition</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="asset">Select Asset</label>
                            <select name="asset" id="asset" class="form-control">

                                <option value="">- Select Asset</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->name }}, Employee - {{ $asset->employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default flat btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary flat btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addPrDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="pr-detail-add" action="{{ route('pr-requisition-details',['id' => $purchase_equisition->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add New Asset Purchase Requisition</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="asset">Select Asset</label>
                            <select name="asset" id="asset" class="form-control">

                                <option value="">- Select Asset</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">{{ $asset->name }}, Employee - {{ $asset->employee->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default flat btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary flat btn-sm">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    @include('../partials.purchase-requisition-details')
    <script>

        $(document).ready(function () {
            $(document).on('click', '.btn-edit-pr-detail',function(e){
                var id = $(this).data('id');
                var url = "{{ route('json-purchase-requisition-detail') }}/" + id;
                var formUrl = "{{ route('update-purchase-requisition-detail') }}/" + id;
                $("#pr-detail-edit").attr('action',formUrl);

                $.ajax({url: url, success: function(result){
                    var optn = '<option value="'+result.asset.id+'">'+result.asset.name+', Employee - '+result.asset.employee.name+'</option>';
                    //console.log(optn);
                    //console.log(result);
                    $("#pr-detail-edit select[name=asset]").append(optn);
                    $("#pr-detail-edit select[name=asset]").val(result.asset.id);
                    $("#pr-detail-edit input[name=price]").val(result.approx_price);
                    $("#pr-detail-edit input[name=quantity]").val(result.quantity);
                }});

            });
            $(document).on('click', '.btn-delete-pr-detail',function(e){
                var id = $(this).data('id');
                var url = "{{ route('delete-purchase-requisition-detail') }}/" + id;

                $.ajax({url: url, success: function(result){
                    getPurchaseReqDetails();
                }});

            });

            $( "#pr-detail-edit" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getPurchaseReqDetails();
                    $("#editPrDetails").modal('hide');
                });
                event.preventDefault();
            });
            $( "#pr-detail-add" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    getPurchaseReqDetails();
                    $("#addPrDetails").modal('hide');
                });
                event.preventDefault();
            });

            function showPurchaseReqDetails (data) {
                Handlebars.registerHelper('ifEditable', function(a, options) {
                    if (a == 0 || a == 1) {
                        return options.fn(this);
                    }

                    return options.inverse(this);
                });

                var theTemplateScript = $("#purchase-requisition-details-list").html();

                // Compile the template
                var theTemplate = Handlebars.compile(theTemplateScript);


                // Pass our data to the template
                var theCompiledHtml = theTemplate(data);
                // Add the compiled html to the page
                $('#purReqDetails').html(theCompiledHtml);

            };

            function getPurchaseReqDetails(){
                var url = "{{ route('json-purchase-requisition-details',['id' => $purchase_equisition->id]) }}";
                $.ajax({url: url, success: function(result){
                    showPurchaseReqDetails(result);
                }});
            }



            getPurchaseReqDetails();

        });

    </script>
@endsection