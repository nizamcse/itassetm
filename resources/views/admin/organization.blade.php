@extends('layouts.admin')

@section('content')
    <div class="box box-default flat">
        <div class="box-header with-border">
            <h3 class="box-title">Organization Information</h3>
            <div class="box-tools pull-right">
                @if($organization)
                    <button class="btn flat btn-info" data-toggle="modal" data-target="#organization">Edit Organization</button>
                @endif
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if(!$organization)
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
                            <button type="submit" class="btn flat btn-success">Save</button>
                        </div>
                    </div>
                </form>
            @endif


            @if($organization)
                <div class="row">
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Name : </strong> {{ $organization->name }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>City : </strong> {{ $organization->city }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Postal Code : </strong> {{ $organization->postal_code }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Address Line 1 : </strong> {{ $organization->address_line_1 }}
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Address Line 2 : </strong> {{ $organization->address_line_2 }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Address Line 3 : </strong> {{ $organization->address_line_3 }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>State : </strong> {{ $organization->state }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Country : </strong> {{ $organization->country }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Phone : </strong> {{ $organization->phone }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Email : </strong> {{ $organization->email }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Fax : </strong> {{ $organization->fax }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Web : </strong> {{ $organization->web }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="organization-widget">
                            <strong>Key : </strong> {{ $organization->key }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if($organization)
        <div class="modal fade flat" id="organization" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('update-organization') }}" method="POST">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Organization Information</h4>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group {{ $errors->first('name')? 'has-error' : '' }}">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Organization Name" value="{{ $organization->name }}">
                                        @if($errors->first('name'))
                                            <span class="help-block">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group {{ $errors->first('address_line_1')? 'has-error' : '' }}">
                                        <label>Addressline 1</label>
                                        <input type="text" class="form-control" name="address_line_1" value="{{ $organization->address_line_1 }}" placeholder="Addressline 1" required>
                                        @if($errors->first('name'))
                                            <span class="help-block">{{ $errors->first('address_line_1') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Addressline 2</label>
                                        <input type="text" class="form-control" value="{{ $organization->address_line_2 }}" name="address_line_2" value="" placeholder="Addressline 2">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Addressline 3</label>
                                        <input type="text" class="form-control" value="{{ $organization->address_line_3 }}" name="address_line_3" value="" placeholder="Addressline 3">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group {{ $errors->first('city')? 'has-error' : '' }}">
                                        <label>City</label>
                                        <input type="text" class="form-control" name="city" value="{{ $organization->city }}" placeholder="City" required>
                                        @if($errors->first('city'))
                                            <span class="help-block">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group {{ $errors->first('postal_code')? 'has-error' : '' }}">
                                        <label>Postal Code</label>
                                        <input type="text" class="form-control" name="postal_code" value="{{ $organization->postal_code }}" placeholder="Postal Code" required maxlength="46">
                                        @if($errors->first('postal_code'))
                                            <span class="help-block">{{ $errors->first('postal_code') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control" name="state" value="{{ $organization->state }}" placeholder="State">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group {{ $errors->first('country')? 'has-error' : '' }}">
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="country" value="{{ $organization->country }}" placeholder="Country" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group {{ $errors->first('phone')? 'has-error' : '' }}">
                                        <label>Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{ $organization->phone }}" placeholder="Phone" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $organization->email }}" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="tex" class="form-control" name="fax" value="{{ $organization->fax }}" placeholder="Fax">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Web</label>
                                        <input type="tex" class="form-control" value="{{ $organization->web }}" name="web" placeholder="Web">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label>Key</label>
                                        <input type="tex" class="form-control" value="{{ $organization->key }}" name="key" placeholder="Key">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn flat btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn flat btn-primary flat">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection