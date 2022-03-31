<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-md-6">
                <h1>{{ucfirst(request()->segment(2))}}</h1>
              </div>
              <div class="col-md-6">
              <a href="{{route(request()->segment(2).'.create')}}" class="nav-link btn btn-sm btn-outline-secondary"> <i class="fas fa-plus px-1"></i> Create {{ucfirst(request()->segment(2))}}</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">{{ucfirst(request()->segment(2))}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>