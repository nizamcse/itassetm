@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">VENDORS</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="submit-status"></div>
            <form action="{{ route('post.vendor') }}" id="vendorForm" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Vendor Name</label>
                            <input class="form-control vendor-name" name="name" type="text" placeholder="Vendor Name" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control vendor-address" name="address" type="text" placeholder="Address" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact-person">Contact Person</label>
                            <input class="form-control vendor-contact-person" name="contact_person" type="text" placeholder="Contact Person" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact-no">Contact No</label>
                            <input class="form-control vendor-contact-no" name="contact_no" type="text" placeholder="Contact No" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="web">Web</label>
                            <input class="form-control vendor-web" name="web" type="text" placeholder="www.example.com" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="trade-no">Trade No</label>
                            <input class="form-control vendor-trade-no" name="trade_no" type="text" placeholder="Trade No" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vat-no">Vat No</label>
                            <input class="form-control vendor-vat-no" name="vat_no" type="text" placeholder="Vat No" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company">Vendor Email</label>
                            <input class="form-control vendor-company" name="email" type="email" placeholder="Vendor Email" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company">Comment</label>
                            <input class="form-control vendor-company" name="comment" type="text" placeholder="Comment" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vendor-type">Vendor Type</label>
                            <select name="vendor_type" id="vendor_type" class="form-control">
                                <option value="">Select Vendor Type</option>
                                @foreach($vendor_types as $vendor_type)
                                    <option value="{{ $vendor_type->id }}">{{ $vendor_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""></label>
                            <button class="btn btn-success btn-add" type="submit" style="margin-top:25px">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <form action="#" id="vendorEditForm" method="POST" style="display: none">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Vendor Name</label>
                            <input class="form-control vendor-name" name="name" type="text" placeholder="Vendor Name" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control vendor-address" name="address" type="text" placeholder="Address" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact-person">Contact Person</label>
                            <input class="form-control vendor-contact-person" name="contact_person" type="text" placeholder="Contact Person" required/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="contact-no">Contact No</label>
                            <input class="form-control vendor-contact-no" name="contact_no" type="text" placeholder="Contact No" required />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="web">Web</label>
                            <input class="form-control vendor-web" name="web" type="text" placeholder="www.example.com" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="trade-no">Trade No</label>
                            <input class="form-control vendor-trade-no" name="trade_no" type="text" placeholder="Trade No" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vat-no">Vat No</label>
                            <input class="form-control vendor-vat-no" name="vat_no" type="text" placeholder="Vat No" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company">Vendor Email</label>
                            <input class="form-control vendor-company" name="email" type="email" placeholder="Vendor Email" />
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="company">Comment</label>
                            <input class="form-control vendor-company" name="comment" type="text" placeholder="Comment" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vendor-type">Vendor Type</label>
                            <select name="vendor_type" id="vendor_type" class="form-control">
                                <option value="">Select Vendor Type</option>
                                @foreach($vendor_types as $vendor_type)
                                    <option value="{{ $vendor_type->id }}">{{ $vendor_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for=""></label>
                            <button class="btn btn-danger btn-cancel-edit" type="button" style="margin-top: 25px">
                                Cancel
                            </button>
                            <button class="btn btn-success btn-save-update" type="submit" style="margin-top: 25px">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        <!-- /.row -->
    </div>
    <div class="x_content">
        <div id="vendorsData"></div>
    </div>
    <div class="box-footer">

    </div>
    </div>
@endsection

@section('script')
    @include('../partials.vendors-list')
    <script>
        $(document).ready(function () {

            $( "#vendorForm" ).on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {
                    $( "#vendorForm" )[0].reset();
                    //$( "#serviceTypeForm" ).css({"display":"none"});

                    $('table#vendorFormTable > tbody > tr:not(:first)').remove();

                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getVendors();
                });
                event.preventDefault();
            });

            function vendorsData(data) {
                Handlebars.registerHelper('ifEnable', function(a, options) {
                    if (a == 1) {
                        return options.fn(this);
                    }

                    return options.inverse(this);
                });

                Handlebars.registerHelper('ifDisable', function(a, options) {
                    if (a == 0) {
                        return options.fn(this);
                    }

                    return options.inverse(this);
                });

                var theTemplateScript = $("#vendors-data-template").html();
                var theTemplate = Handlebars.compile(theTemplateScript);
                var theCompiledHtml = theTemplate(data);
                $('#vendorsData').html(theCompiledHtml);
                initializeDatatable();
            }

            function initializeDatatable() {
                $('#datatableN').DataTable();
            }

            var getVendors = function () {
                $.ajax({url: "{{ route('json-vendors') }}", success: function(result){
                    vendorsData(result);
                }});
            };

            $(document).on('click','.btn-delete',function (e) {
                console.log($(this));
                var url = "{{ route('json-delete-vendors') }}/"+$(this).data('id');

                $.ajax({
                    type        : 'GET',
                    url         : url,
                    encode      : true
                }).done(function(data) {
                    console.log(data);
                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getVendors();
                });
            });

            $(document).on('click','.btn-enable',function (e) {
                var url = "{{ route('enable-vendor') }}/"+$(this).data('id');
                $.ajax({url: url, success: function(result){
                    getVendors();
                }});
            });

            $(document).on('click','.btn-disable',function (e) {
                var url = "{{ route('disable-vendor') }}/"+$(this).data('id');
                $.ajax({url: url, success: function(result){
                    getVendors();
                }});
            });

            $(document).on('click','.btn-edit',function (e){
                var id = $(this).data('id');
                $.ajax({url: "{{ route('json-vendor') }}/"+id, success: function(result){
                    editFormValue(result.vendor);
                }});
            });

            function editFormValue(data) {
                var url = "{{ route('update-vendor') }}/"+data.id;
                $("#vendorEditForm").attr('action',url);
                $("#vendorEditForm").css({"display" : "block"});
                $("#vendorForm").css({"display" : "none"});

                $("#vendorEditForm input[name='name']").val(data.name);
                $("#vendorEditForm input[name='address']").val(data.address);
                $("#vendorEditForm input[name='contact_person']").val(data.contact_person);
                $("#vendorEditForm input[name='contact_no']").val(data.contact_no);
                $("#vendorEditForm input[name='web']").val(data.web);
                $("#vendorEditForm input[name='trade_no']").val(data.trade_no);
                $("#vendorEditForm input[name='vat_no']").val(data.vat_no);
                $("#vendorEditForm input[name='email']").val(data.email);
                $("#vendorEditForm input[name='comment']").val(data.comment);
                $("#vendorEditForm select[name='vendor_type']").val(data.vendor_type_id);
            }

            $("#vendorEditForm").on( "submit", function( event ) {
                var formData = $( this ).serialize();
                var url = $( this ).attr('action');
                $.ajax({
                    type        : 'POST',
                    url         : url,
                    data        : formData,
                    encode          : true
                }).done(function(data) {

                    $("#vendorEditForm").css({"display" : "none"});
                    $("#vendorEditForm")[0].reset();
                    $("#vendorForm").css({"display" : "block"});
                    $msg = '<div class="alert alert-success">'+data.message+'</div>';
                    $("#submit-status").html($msg);
                    getVendors();
                });
                event.preventDefault();
            });

            $(document).on('click','.btn-cancel-edit',function (e) {
                $("#vendorEditForm").css({"display" : "none"});
                $("#vendorEditForm")[0].reset();
                $("#vendorForm").css({"display" : "block"});
            });

            getVendors();
        });
    </script>
@endsection