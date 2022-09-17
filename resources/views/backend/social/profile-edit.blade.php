@extends('backend.layouts.app') @section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manage Profile</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <a href="{{route('profile-management.profile')}}" class="btn btn-info btn-sm"><i class="fas fa-stream"></i> View Resource Person</a> --}}
                    </div>
                    <div class="card-body">
                        <form action="{{!empty($editData)? route('profile-management.profile.update',$editData->id) : route('profile-management.profile')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-sm-4">
                                    <label>Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" autocomplete="off" value="{{ !empty($editData->name)? $editData->name : old('name') }}"> @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="off" value="{{ !empty($editData->email)? $editData->email : old('email') }}"> @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" autocomplete="off" value="{{ !empty($editData->phone)? $editData->phone : old('phone') }}"> @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                                <div class="form-group col-sm-4">
                                    <label>Profile Image</label>
                                    <input type="file" class="form-control filer_input_single @error('image') is-invalid @enderror" name="image"> @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>
                                
                                
                                <div class="form-group col-sm-6">
                                    <label>Address</label>
                                    <textarea type="text" class="form-control  @error('address') is-invalid @enderror" name="address" rows="5">{{ !empty($editData->address)? $editData->address : old('address') }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span> @enderror
                                </div>

                                

                            </div>

                            <button class="btn bg-gradient-success btn-flat"><i class="fas fa-save"></i> {{ !empty($editData)? 'Update' : 'Save' }}</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!--/. container-fluid -->
</section>
@endsection