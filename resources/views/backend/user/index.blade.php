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
                    <th>Full Name</th>                                    
                    <th>Photo</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $user->fullname }}</td>
                      <td><img src="{{ $user->photo }}" alt="user image" style="height: 100px; width: 100px; border-radius: 50%;"></td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->phone}}</td>
                      <td>{{$user->role}}</td>
                      <td>
                        <input name="toggle" value="{{ $user->id }}" type="checkbox" data-toggle="switchbutton" {{ $user->status == 'active' ? 'checked' : '' }} data-onlabel="Active" data-offlabel="Inactive" data-size="sm" data-onstyle="success" data-offstyle="danger">
                      </td>
                      <td class="row">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#userID{{$user->id}}" class="col-md-4 btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="view"  data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <a href="{{route('user.edit',$user->id)}}" class="col-md-4 btn btn-sm btn-outline-warning" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form class="col-md-4" action="{{route('user.destroy',$user->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <a href="" data-id="{{$user->id}}" class="delBtn btn btn-sm btn-outline-danger" data-toggle="tooltip" title="delete" data-placement="bottom"><i class="fas fa-trash"></i></a>
                        </form>
                      </td>
                      {{--User Modal --}}
                        <div class="modal fade" id="userID{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            @php
                              $userV = \App\Models\User::where('id',$user->id)->first();
                            @endphp
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title text-center" id="exampleModalLongTitle">{{strtoupper($userV->fullname)}}</h5>
                                
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="row {{ $userV->photo ? '' : 'd-none'}} mb-3" style="height: 120px"> 
                                  <div class="col-md-12 text-center" style="height: 120px">
                                    <img class="img-responsive" src="{{$userV->photo}}" style="width: 130px; height: 130px; border-radius: 50%;" alt="User photo">
                                  </div> 
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-md-6">
                                  
                                    <div class="row mt-1">
                                      <strong>Email</strong>
                                      <div class="col-md-12">
                                        <p>{{$userV->email}}</p>
                                      </div>
                                    </div>
                                    <div class="row mt-1">
                                      <strong>Address</strong>
                                      <div class="col-md-12">
                                        <p>{!!$userV->address!!}</p>
                                      </div>
                                    </div>                                 
                                     <div class="row mt-1">
                                      <strong>Username</strong>
                                      <div class="col-md-12">
                                        <p>{{ucfirst($userV->username)}}</p>
                                      </div>
                                    </div>                                 
                                    
                                    
                                  </div>
                                  <div class="col-md-6 pl-4">
                                    <div class="row mt-1">
                                      <strong>Role</strong>
                                      <div class="col-md-12">
                                        <p>{{ucfirst($userV->role)}}</p>
                                      </div>
                                    </div>
                                    <div class="row mt-1">
                                      <strong>Address</strong>
                                      <div class="col-md-12">
                                        <p>{!!$userV->address!!}</p>
                                      </div>
                                    </div>                                 
                                    <div class="row mt-1">
                                      <strong>Status</strong>
                                      <div class="col-md-12">
                                        <p class="badge badge-warning" style="padding: 10px;">{{ucfirst($userV->status)}}</p>
                                      </div>
                                    </div> 
                                     <div class="row mt-1">
                                      <strong>Phone</strong>
                                      <div class="col-md-12">
                                        <p>{{$userV->phone}}</p>
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
  })
  </script>
  <script>
    $('input[name=toggle]').change(function (e) {
      e.preventDefault() 
      let mode = $(this).prop('checked');
      let id = $(this).val();
    
      $.ajax({
        url: "{{ route('user.status') }}",
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