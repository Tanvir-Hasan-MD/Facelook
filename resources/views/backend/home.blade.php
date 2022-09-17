@extends('backend.layouts.app')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <!-- <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div> -->
  </div>
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
     <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
            src="{{ !empty($user['image'])? asset('public/upload/user_image/'.$user['image']) : asset('public/upload/user_image/profile.jpg') }}"
            alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{$user['name']}}</h3>

          <!-- <p class="text-muted text-center">Software Engineer</p> -->

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Email</b> <a class="float-right">{{$user['email']}}</a>
            </li>
            <li class="list-group-item">
              <b>phone</b> <a class="float-right">{{$user['phone']}}</a>
            </li>
            <li class="list-group-item">
              <b>Address</b> <a class="float-right">{!! $user['address'] !!}</a>
            </li>
          </ul>

          <a href="{{route('profile-management.profile.edit',$user['id'])}}" class="btn btn-primary btn-block"><b>Edit</b></a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
     
      <!-- /.card -->
    </div>
    <div class="col-md-9" style="margin-top: -28px;">
      <div class="card-body">
        <div class="tab-content">
          <form action="{{route('post.add')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
              <div class="form-group col-sm-12">
                <h4>Create Post</h4>
                <textarea type="text" class="form-control textarea @error('description') is-invalid @enderror" name="description" rows="5"></textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> @enderror
              </div> 

            </div>
            <center> <button class="btn btn-sm btn-info "><i class="fas fa-save"></i> Post</button></center>
          </form>

          <!-- Post -->
          @foreach($post as $key => $value)
          <div class="post">
            <div class="user-block">
              <img class="img-circle img-bordered-sm" src="{{ !empty($value['user']['image'])? asset('public/upload/user_image/'.$value['user']['image']) : asset('public/upload/user_image/profile.jpg') }}" alt="user image">
              <span class="username">
                <a href="#">{{$value['user']['name']}}</a>
                <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
              </span>
              <span class="description">{{Date('h:i a',strtotime($value['created_at']))}} - {{Date('D-M-Y',strtotime($value['created_at']))}}</span>
            </div>
            <!-- /.user-block -->
            <p>
              {!! $value['description'] !!}
            </p>
            @if($value['user']['id'] == $user['id'])
            <button id="post_delete" value="{{$value['id']}}" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</button>

            @endif
            <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
          </div>
          @endforeach
          <!-- /.post -->

        </div>
        <!-- /.tab-content -->
      </div>

    </div>
    <!-- /.col -->
  </div>  
</div>
<!--/. container-fluid -->
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on("click","#post_delete",function(){
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, Deleted!'
          }).then((result) => {
              if (result.value) {
                var id = $(this).val();
                // alert(id);
                $.ajax({
                    url: '{{route("post.delete")}}',
                    type: "GET",
                    dataType: "json",
                    data: { id: id },
                    success: function (data) {
                        if(data == 'closed')
                        {
                           Swal.fire(
                              'Deleted!',
                              'success').then((result) => {
                               if(result){
                                location.reload();
                            }  
                        })
                          }
                      },
                  });

            }
        })
      })
    })
</script>
@endsection

