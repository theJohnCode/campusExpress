@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
   @include('backend.layouts.be')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="col-12">
              @if ($errors->any())
                <div>
                  <ul style="list-style: none;">
                  @foreach ($errors->all() as $error)
                    <li class="alert alert-danger">{{$error}}</li>
                  @endforeach
                </ul>
                </div>
              @endif
            </div>
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
                <form action="{{route('user.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('patch')
                {{-- Title input --}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="fullname" class="form-control"  placeholder="Title" value="{{$user->fullname}}">
                  </div>
                  
                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                    <label for="title">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control"  placeholder="Title" value="{{$user->username}}">
                  </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                    <label for="title">Email <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control"  placeholder="Title" value="{{$user->email}}">
                  </div>
                    </div>

                    {{-- <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                    <label for="title">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control"  placeholder="Title" value="{{$user->password}}">
                  </div>
                    </div> --}}

                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                    <label for="title">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control"  placeholder="Title" value="{{$user->phone}}">
                  </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                    <label for="title">Address <span class="text-danger">*</span></label>
                    <textarea id="address" class="form-control" name="address" placeholder="Enter ...">{{$user->address}}</textarea>
                  </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                    <label for="title">Role <span class="text-danger">*</span></label>
                    <select name="role" class="form-control">
                      <option>-- Role --</option>

                      <option value="admin" {{$user->role == 'admin' ? "selected" : ''}}>Admin</option>

                      <option value="vendor" {{$user->role == 'vendor' ? 'selected' : ''}}>Vendor</option>
                      
                      <option value="customer" {{$user->role == 'customer' ? 'selected' : ''}}>Customer</option>
                    </select>
                  </div>
                    </div>

                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail"  data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                            </a>
                      </span>
                      <input id="thumbnail" class="form-control" type="text" value="{{$user->photo}}" name="photo">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
         
        </div>
        <!-- /.row -->
      </div><!-- /.\iner-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>

<script>
  $('#lfm').filemanager('image');
</script>
<script>
  $(document).ready(function() {
  $('#address').summernote();
});
</script>
@endsection