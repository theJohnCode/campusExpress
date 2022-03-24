@extends('backend.layouts.master')

@section('datatablecss')
    @include('backend.extra.datatablecss')
@endsection


@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
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
                    <th>is parent</th>
                    <th>Parent</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $category->title }}</td>
                      <td><img src="{{ $category->photo }}" alt="category image" style="max-height: 90px; max-width: 120px;"></td>
                      <td>{{$category->is_parent === 1 ? 'Yes' : 'No'}}</td>
                      <td>{{\App\Models\Category::where('id',$category->parent_id)->value('title')}}</td>
                      <td>
                        <input name="toggle" value="{{ $category->id }}" type="checkbox" data-toggle="switchbutton" {{ $category->status == 'active' ? 'checked' : '' }} data-onlabel="Active" data-offlabel="Inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td>
                        <a href="{{route('category.edit',$category->id)}}" class="float-left btn btn-sm btn-outline-warning" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        
                        <form class="float-right" action="{{route('category.destroy',$category->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <a href="" data-id="{{$category->id}}" class="delBtn btn btn-sm btn-outline-danger" data-toggle="tooltip" title="delete" data-placement="bottom"><i class="fas fa-trash"></i></a>
                        </form>
                      </td>
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
        url: "{{ route('category.status') }}",
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
@endsection