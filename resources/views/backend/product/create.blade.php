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
                <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                {{-- Title input --}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control"  placeholder="Title" value="{{old('title')}}">
                  </div>
                  <div class="col-sm-12 col-md-12">
                      <!-- Summary -->
                      <div class="form-group">
                        <label>Summary <span class="text-danger">*</span></label>
                        <textarea id="summary" class="form-control" name="summary" placeholder="Enter ...">{{old('summary')}}</textarea>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                      <!-- Description -->
                      <div class="form-group">
                        <label>Description</label>
                        <textarea id="description" class="form-control" name="description" placeholder="Enter ...">{{old('description')}}</textarea>
                      </div>
                    </div>
                    
                    <div class="col-sm-12">
                      <!-- stock -->
                      <div class="form-group">
                        <label>Stock <span class="text-danger">*</span></label>
                        <input class="form-control" type="number" name="stock" id="stock" value="{{old('stock')}}">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <!-- price -->
                      <div class="form-group">
                        <label>Price <span class="text-danger">*</span></label>
                        <input class="form-control" step="any" type="number" name="price" id="price" value="{{old('price')}}">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <!-- discount -->
                      <div class="form-group">
                        <label>Discount</label>
                        <input class="form-control" step="any" min="0" max="100" type="number" name="discount" id="discount" value="{{old('discount')}}">
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <!-- Size -->
                      <div class="form-group">
                        <label>Size</label>
                        <select name="size" class="form-control">
                          <option>-- Select --</option>
                          <option value="S" {{old('size') == 'S' ? "selected" : ''}}>Small</option>
                          <option value="M" {{old('size') == 'M' ? 'selecetd' : ''}}>Medium</option>
                          <option value="L" {{old('size') == 'L' ? 'selecetd' : ''}}>Large</option>
                          <option value="XL" {{old('size') == 'XL' ? 'selecetd' : ''}}>Extra Large</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <!-- Status -->
                      <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                          <option>-- Status --</option>
                          <option value="active" {{old('status') == 'active' ? "selected" : ''}}>Active</option>
                          <option value="inactive" {{old('status') == 'inactive' ? 'selecetd' : ''}}>Inactive</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <!-- Brand -->
                      <div class="form-group">
                        <label>Brand</label>
                        <select name="brand_id" class="form-control">
                          <option>-- Brand --</option>
                          @foreach (\App\Models\Brand::get() as $brand)
                            <option value="{{$brand->id}}" {{ old('brand_id') == $brand->id ? 'selected' : ''}}>{{$brand->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <!-- Category -->
                      <div class="form-group">
                        <label>Category</label>
                        <select name="cat_id" class="form-control" id="cat_select">
                          <option>-- Category --</option>
                          @foreach (\App\Models\Category::where('is_parent',1)->get() as $category)
                            <option value="{{$category->id}}" {{ old('cat_id') == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12 d-none" id="child_cat">
                      <!-- Child Category -->
                      <div class="form-group">
                        <label>Child Category</label>
                        <select name="child_cat_id" class="form-control" id="child_select">
                       
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <!-- Vendor -->
                      <div class="form-group">
                        <label>Vendor</label>
                        <select name="vendor_id" class="form-control">
                          <option>-- Vendor --</option>
                          @foreach (\App\Models\User::where('role','vendor')->get() as $vendor)
                            <option value="{{$vendor->id}}" {{ old('vendor_id') == $vendor->id ? 'selected' : ''}}>{{$vendor->fullname}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="col-sm-12">
                      <!-- select -->
                      <div class="form-group">
                        <label>Conditions</label>
                        <select name="conditions" class="form-control">
                          <option>-- Condition --</option>
                          <option value="new" {{old('conditions') == 'new' ? "selected" : ''}}>New</option>
                          <option value="winter" {{old('conditions') == 'winter' ? "selected" : ''}}>Winter</option>
                          <option value="popular" {{old('conditions') == 'popular' ? "selected" : ''}}>Popular</option>
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
  $('#description').summernote();
});
</script>
<script>
  $(document).ready(function() {
  $('#summary').summernote();
});
</script>
<script>
   $('#cat_select').change(function (e) { 
     e.preventDefault();
     let selected = $(this).val();
      
     if(selected != null){
       $.ajax({
         type: "POST",
         url: "/admin/category/"+selected+"/child",
         data: {
           _token: "{{ csrf_token() }}",
           selected: selected
         },
         success: function (response) {
           //console.log(response.data);
           let option = `<option value=''> -- Child Category -- </option>`;
           if(response.status){
             $('#child_cat').removeClass('d-none');
             $.each(response.data,function(id,title){
              option += `<option value='${id}'>${title}</option>`;
             });
           } else{
             $('#child_cat').addClass('d-none');
           }
           $('#child_select').html(option);
         }
       });
     }
   });
</script>
@endsection