@extends('layouts.admin.default')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Exam List</h1>
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
                    
                <!-- /.card-header -->
                <!-- form start -->
                    <form action="{{ route('question.update',$data->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input type="hidden" name="exam_id" value="{{ $data->exam_id }}">
                      <div class="card-body">
                        <div class="form-group">
                            <label for="examname">Title</label>
                            <input type="text" name="title" class="form-control" id="examname" placeholder="Enter title" value="{{ $data->title }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" id="description" placeholder="Enter description">{{ $data->description }}</textarea>
                        </div>
                        <div class="form-group">
                          <label for="description">Upload Image</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="imgPreview" name="image" accept=".jpg,.png,.webp"  id="exampleInputFile">
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                          </div>
                          <img id="blah" src="{{url('/images/'.$data->image.'')}}" alt="your image" style="width:200px; height:200px;"/>
                        </div>
                        <div class="form-group">
                            <label for="answer1">Answer1 (Right Answer)</label>
                            <input type="text" name="answer[]" class="form-control" id="answer1" placeholder="Enter Correct Answer" value="{{ $data->answer[0]->title }}">
                        </div>
                        <div class="form-group">
                            <label for="answer2">Answer2</label>
                            <input type="text" name="answer[]" class="form-control" id="answer2" placeholder="Enter Wrong Answer" value="{{ $data->answer[1]->title }}">
                        </div>
                        <div class="form-group">
                            <label for="answer3">Answer3</label>
                            <input type="text" name="answer[]" class="form-control" id="answer3" placeholder="Enter Wrong Answer" value="{{ $data->answer[2]->title }}">
                        </div>
                        <div class="form-group">
                            <label for="answer4">Answer4</label>
                            <input type="text" name="answer[]" class="form-control" id="answer4" placeholder="Enter Wrong Answer" value="{{ $data->answer[3]->title }}">
                        </div>
                        <div class="form-group">
                            <label for="marks">Marks</label>
                            <input type="number" step="0.5"  min="0" name="marks" class="form-control" id="marks" value="{{ $data->marks }}">
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
<script>
imgPreview.onchange = evt => {
  const [file] = imgPreview.files
  if (file) {
    blah.src = URL.createObjectURL(file)
  }
}
</script>
@endpush