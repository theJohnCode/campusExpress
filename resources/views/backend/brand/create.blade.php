@extends('backend.layouts.master')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('backend.layouts.ba')

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
                <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                {{-- Title input --}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control"  placeholder="Title" value="{{old('title')}}">
                  </div>
                  
                    
                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option>-- Select --</option>
                          <option value="active" {{old('status') == 'active' ? "selected" : ''}}>Active</option>
                          <option value="inactive" {{old('status') == 'inactive' ? 'selecetd' : ''}}>Inactive</option>
                        </select>
                      </div>
                    </div>

                    
                  <div class="form-group">
                    <label for="exampleInputFile">File input <span class="text-danger">*</span></label>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <a id="lfm" data-input="thumbnail"  data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                            </a>
                      </span>
                      <input id="thumbnail" class="form-control" type="text" name="photo">
                    </div>
                    <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                    </div>
                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
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