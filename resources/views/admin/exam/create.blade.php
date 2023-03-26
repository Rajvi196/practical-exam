@extends('layouts.admin.default')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Exam Form</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="col-sm-3" style="float:right">
              <a href="{{ route('exam.index')}}" class="btn btn-block btn-primary">Back</a>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
          <div class="col-12">
            <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Quick Example</h3>
                    </div>
                <!-- /.card-header -->
                <!-- form start -->
                    <form action="{{ route('exam.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      
                      <div class="card-body">
                        <div class="form-group">
                            <label for="examname">Exam Title</label>
                            <input type="text" name="exam_name" class="form-control" id="examname" placeholder="Enter exam name">
                        </div>
                        <div class="form-group">
                            <label for="examtime">Exam Time</label>  Hours:
                            <select class="form-group" name="hours">
                              @for($i = 0; $i < 24; $i++)
                                <option value="{{ sprintf("%02d", $i); }}">{{ sprintf("%02d", $i); }}</option>
                              @endfor
                            </select>: Minutes
                            <select class="form-group" name="minutes">
                              <?php for($i = 0; $i < 60; $i++): ?>
                                <option value="{{ sprintf("%02d", $i); }}">{{ sprintf("%02d", $i); }}</option>
                              <?php endfor ?>
                            </select>: Seconds
                            <select class="form-group" name="seconds">
                              <?php for($i = 0; $i < 60; $i++): ?>
                                <option value="{{ sprintf("%02d", $i); }}">{{ sprintf("%02d", $i); }}</option>
                              <?php endfor ?>
                            </select>
                        </div>
                        
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
@push('scripts')


@endpush