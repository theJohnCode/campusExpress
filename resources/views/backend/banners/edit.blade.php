@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Banner</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit Banner</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <div class="col-12">
              @if ($errors->any())
                <div class="alert aler-danger">
                  <ul style="list-style: none;">
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
                </div>
              @endif
            </div>
            <!-- general form elements -->
            <div class="card card-primary">
              <!-- /.card-header -->
              <!-- form start -->
                <form action="{{route('banner.update',$banner->id)}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('patch')
                {{-- Title input --}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"  placeholder="Title" value="{{$banner->title}}">
                  </div>
                  
                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Description</label>
                        <textarea id="description" class="form-control" name="description" placeholder="Enter ...">{{$banner->description}}</textarea>
                      </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option>-- Select --</option>
                          <option value="active" {{$banner->status == 'active' ? "selected" : ''}}>Active</option>
                          <option value="inactive" {{$banner->status == 'inactive' ? 'selecetd' : ''}}>Inactive</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Condition</label>
                        <select name="condition" class="form-control">
                          <option>-- Select --</option>
                          <option value="banner" {{$banner->condition == 'banner' ? "selected" : ''}}>Banner</option>
                          <option value="promo" {{$banner->condition == 'promo' ? "selected" : ''}}>Promoted</option>
                        </select>
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
  $('#description').summernote();
});
</script>
@endsection