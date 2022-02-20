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
              <li class="breadcrumb-item active">Add Banner</li>
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
            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST">
                {{-- Title input --}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"  placeholder="Title" value="{{old('title')}}">
                  </div>
                  
                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Description</label>
                        <textarea id="description" class="form-control" name="description" placeholder="Enter ...">{{old('description')}}</textarea>
                      </div>
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

                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Condition</label>
                        <select name="condition" class="form-control">
                          <option>-- Select --</option>
                          <option value="banner" {{old('condition') == 'banner' ? "selected" : ''}}>Banner</option>
                          <option value="promo" {{old('condition') == 'promo' ? "selected" : ''}}>Promoted</option>
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
                      <input id="thumbnail" class="form-control" type="text" name="filepath">
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
      </div><!-- /.container-fluid -->
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