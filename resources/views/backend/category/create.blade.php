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
                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                {{-- Title input --}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"  placeholder="Title" value="{{old('title')}}">
                  </div>
                  
                    <div class="col-sm-12 col-md-12">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Summary</label>
                        <textarea id="summary" class="form-control" name="summary" placeholder="Enter ...">{{old('summary')}}</textarea>
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
                        <label>Is Parent: </label>
                        <input type="checkbox" name="is_parent" id="is_parent" value="1"> tick to make it Parent
                      </div>
                    </div>

                    <div class="col-sm-12" id="parent_cat_div">
                      <!-- select -->
                      <div class="form-group">
                        <label>Parent Category</label>
                        <select name="parent_id" class="form-control">
                          <option>-- Parent Category --</option>
                          @foreach ($parent_category as $pc)
                            <option value="{{$pc->id}}" {{old('parent_id') == $pc->id ? 'selected' : ''}}>{{$pc->title}}</option>
                          @endforeach
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
  $('#summary').summernote();
});
</script>
<script>
 $(document).ready(function () {
    $('#is_parent').change(function(e){
    e.preventDefault();
    let is_checked = $('#is_parent').prop('checked');
    if(is_checked){
      $('#parent_cat_div').addClass('d-none');
      //console.log($('#parent_cat_div select'));
      $('#parent_cat_div select').val('');
    }else{
      $('#parent_cat_div').removeClass('d-none');
      // console.log($('#parent_cat_div select').val());
      // console.log($('#parent_cat_div select'));
    }
  });
 });
</script>
@endsection