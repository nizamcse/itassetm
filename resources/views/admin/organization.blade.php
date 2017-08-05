@extends('layouts.admin')

@section('content')
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Organization Information</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <form action="{{ route('post.organization') }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group {{ $errors->first('name')? 'has-error' : '' }}">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Organization Name">
                            @if($errors->first('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group {{ $errors->first('address_line_1')? 'has-error' : '' }}">
                            <label>Addressline 1</label>
                            <input type="text" class="form-control" name="address_line_1" value="" placeholder="Addressline 1" required=>
                            @if($errors->first('name'))
                                <span class="help-block">{{ $errors->first('address_line_1') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>Addressline 2</label>
                            <input type="text" class="form-control" name="address_line_2" value="" placeholder="Addressline 2">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>Addressline 3</label>
                            <input type="text" class="form-control" name="address_line_3" value="" placeholder="Addressline 3">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group {{ $errors->first('city')? 'has-error' : '' }}">
                            <label>City</label>
                            <input type="text" class="form-control" name="city" value="" placeholder="City" required>
                            @if($errors->first('city'))
                                <span class="help-block">{{ $errors->first('city') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group {{ $errors->first('postal_code')? 'has-error' : '' }}">
                            <label>Postal Code</label>
                            <input type="text" class="form-control" name="postal_code" value="" placeholder="Postal Code" required maxlength="46">
                            @if($errors->first('postal_code'))
                                <span class="help-block">{{ $errors->first('postal_code') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" class="form-control" name="state" value="" placeholder="State">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group {{ $errors->first('country')? 'has-error' : '' }}">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" value="" placeholder="Country" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group {{ $errors->first('phone')? 'has-error' : '' }}">
                            <label>Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>Fax</label>
                            <input type="tex" class="form-control" name="fax" placeholder="Fax">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>Web</label>
                            <input type="tex" class="form-control" name="web" placeholder="Web">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>Key</label>
                            <input type="tex" class="form-control" name="key" placeholder="Key">
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection