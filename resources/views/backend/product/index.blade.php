@extends('backend.layouts.master')

@section('datatablecss')
    @include('backend.extra.datatablecss')
@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   @include('backend.layouts.bi')
   
    <div class="row">
      <div class="col-lg-12">
        @include('backend/layouts/notification')
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Title</th>
                    <th>Photo</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Size</th>
                    <th>Condition</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($products as $product)
                    @php
                      $photo = explode(',',$product->photo)
                    @endphp
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $product->title }}</td>
                      <td><img src="{{ $photo[0] }}" alt="product image" style="max-height: 90px; max-width: 120px;"></td>
                      <td>{{number_format($product->price,2)}}</td>
                      <td>{{$product->discount}}%</td>
                      <td>{{$product->size}}</td>
                      <td>
                        @if ($product->conditions == 'new')
                          <span class="badge badge-success" style="padding: 10px; width: 100px;">{{ $product->conditions }}</span>
                        @elseif($product->conditions == 'popular')
                          <span class="badge badge-warning" style="padding: 10px; width: 100px;">{{ $product->conditions }}</span>
                        @else
                          <span class="badge badge-primary" style="padding: 10px; width: 100px;">{{ $product->conditions }}</span>
                        @endif
                      </td>
                      <td>
                        <input name="toggle" value="{{ $product->id }}" type="checkbox" data-toggle="switchbutton" {{ $product->status == 'active' ? 'checked' : '' }} data-onlabel="Active" data-offlabel="Inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#productID{{$product->id}}" class="float-left btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="view"  data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <a href="{{route('product.edit',$product->id)}}" class="float-left btn btn-sm btn-outline-warning" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form class="float-right" action="{{route('product.destroy',$product->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <a href="" data-id="{{$product->id}}" class="delBtn btn btn-sm btn-outline-danger" data-toggle="tooltip" title="delete" data-placement="bottom"><i class="fas fa-trash"></i></a>
                        </form>
                      </td>

                      {{--Product Modal --}}
                        <div class="modal fade" id="productID{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            @php
                              $prod = \App\Models\Product::where('id',$product->id)->first();
                            @endphp
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">{{strtoupper($prod->title)}}</h5>
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="row {{ $prod->photo ? '' : 'd-none'}}">
                                      <div class="col-12">
                                        <img src="{{$prod->photo}}" style="width: 100%; heigth: 150px;" alt="Product photo">
                                      </div>
                                    </div>
                                    <div class="row mt-1">
                                      <strong>Summary</strong>
                                      <div class="col-12">
                                        <p>{!!$prod->summary!!}</p>
                                      </div>
                                    </div>
                                    <div class="row mt-1">
                                      <strong>Description</strong>
                                      <div class="col-12">
                                        <p>{!!$prod->description!!}</p>
                                      </div>
                                    </div>                                 
                                    <div class="row mt-1">
                                      <div class="col-md-6">
                                        <strong>Brand</strong>
                                        <p>{{ \App\Models\Brand::where('id',$prod->brand_id)->value('title')}}</p>
                                      </div>                                     
                                    </div>
                                    
                                  </div>
                                  <div class="col-md-6 pl-4">
                                    <div class="row">
      
                                      <div class="col-md-6">
                                        <strong>Price</strong>
                                        <p>{{number_format($prod->price, 2)}}</p>
                                      </div>
                                      <div class="col-md-6">
                                        <strong>Offer Price</strong>
                                        <p>{{number_format($prod->offer_price, 2)}}</p>
                                      </div>
                                    </div>
                                    
                                    <div class="row mt-1">
                                      <div class="col-md-6">
                                        <strong>Discount</strong>
                                        <p>{{ $prod->discount }}%</p>
                                      </div>
                                      <div class="col-md-6">
                                        <strong>Stock</strong>
                                        <p>{{ $prod->stock }}</p>
                                      </div>
                                    </div>
                                    <div class="row mt-1">
                                      
                                      <div class="col-md-6">
                                        <strong>Category</strong>
                                        <p>{{ \App\Models\Category::where('id',$prod->cat_id)->value('title')}}</p>
                                      </div>
                                      <div class="col-md-6 {{$prod->child_cat_id ? '' : 'd-none'}}">
                                        <strong>Child Category</strong>
                                        <p>{{ \App\Models\Category::where('id',$prod->child_cat_id)->value('title')}}</p>
                                      </div>
                                    </div>
                                   
                                    <div class="row mt-1">
                                      <div class="col-md-6">
                                        <strong>Size</strong>
                                        <p class="badge badge-success" style="padding: 10px; width: 100px; font-size: 20px;">{{$prod->size}}</p>
                                      </div>
                                      
                                      <div class="col-md-6">
                                         <strong>Condition</strong>
                                        <p class="badge badge-primary" style="padding: 10px; width: 100px;">{{ $prod->conditions }}</p>
                                      </div>
                                    </div>
                                    <div class="row mt-1">
                                      <div class="col-md-12">
                                         <strong>Vendor</strong>
                                        <p>{{ \App\Models\User::where('id',$prod->vendor_id)->value('fullname')}}</p>
                                      </div>
                                    </div>
                                   
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </tr>
                  @endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('datatablejs')
    @include('backend.extra.datatablejs')
@endsection
@section('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $('.delBtn').click(function(e){
    let form = $(this).closest('form');
    let dataid = $(this).data('id')
    e.preventDefault();

    swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover it!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        form.submit();
        swal("Poof! Your file has been deleted!", {
          icon: "success",
        });
      } else {
        swal("Your file is safe!");
      }
});
  });
  </script>
  <script>
    $('input[name=toggle]').change(function (e) {
      e.preventDefault() 
      let mode = $(this).prop('checked');
      let id = $(this).val();
    
      $.ajax({
        url: "{{ route('product.status') }}",
        type: "POST",
        data: {
          _token: '{{csrf_token()}}',
          mode: mode,
          id: id
        },
        success: function (response) {
          if(response.status){
            alert(response.msg)
          }else{
            alert('Please try again')
          }
        },
        error: function(err){
          console.log(err.responseText);
        }
      });
    });
  </script>
  <script>
    $('#btnModal').click(function (e) { 
      e.preventDefault();
      $('#exampleModalCenter').modal();
    });
   
  </script>
@endsection