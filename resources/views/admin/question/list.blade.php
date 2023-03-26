@extends('layouts.admin.default')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Question List</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <div class="col-sm-3" style="float:right">
            
              <a href="{{ route('question.create',['id' => $id ]) }}" class="btn btn-block btn-primary">Create Question</a>
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
              
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Marks</th>
                    <th>Answer1</th>
                    <th>Answer2</th>
                    <th>Answer3</th>
                    <th>Answer4</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $examdata)
                      <tr>
                        <td>{{ $examdata->title }}</td>
                        <td>{{ $examdata->description }}</td>
                        <td>{{ $examdata->marks }}</td>
                        <td>{{ $examdata->answer[0]->title }}</td>
                        <td>{{ $examdata->answer[1]->title }}</td>
                        <td>{{ $examdata->answer[2]->title }}</td>
                        <td>{{ $examdata->answer[3]->title }}</td>
                        <td>
                          <a href="{{ route('question.edit',$examdata->id) }}" class="btn btn-warning btn-xs"><i class="fa fa-fw fa-edit"></i></a>					
                          <a href="javascript:deleteExam({{$examdata['id']}});" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                          <a href="javascript:changestatus({{$examdata['id']}},{{ $examdata['status'] }});" class="btn @if($examdata['status'] == 0) btn-danger @else btn-success @endif  btn-xs"><i class="fa fa-camera" aria-hidden="true"></i></a>
                          
                        </td>

                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!--Delete modal-->
<div class="modal fade" id="deleteModal" aria-modal="true" role="dialog" style="padding-right: 17px;">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Danger Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title" id="myModalLabel">Do you really wish to delete?</h4>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline-light" id="deleteExamYes">Yes</button>
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="statuschange" style="padding-right: 17px;" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <div class="modal-header">
          <h4 class="modal-title">Info Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="modal-title" id="myModalLabel">Do you really wish to change visibility?</h4>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-light" id="changestatus">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
    
@endsection
@push('scripts')
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script type="text/javascript"> 
  $(function () {
   
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  function deleteExam(id){
    $('#deleteModal #deleteExamYes').attr("onclick",'deleteConfirm('+id+')');
    $("#deleteModal").modal("show");
  }
  function deleteConfirm(id){
    $("#deleteModal").modal("hide");

    let token = $('meta[name="csrf-token"]').attr('content');

    /* set ajax request custom header */
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': token
      }
    });

    /* ajax */
    $.ajax({
      url : '{{ route('question.destroy','')}}'+"/"+id,
      type : 'post',
      dataType : 'JSON',
      data : {
        '_method' : 'DELETE',
      },
      success : function(data){
        location.reload();
      },
      error : function(data){
        alert('error in delete data');
      }
    })
  }
  function changestatus(id,status){
    $('#statuschange #changestatus').attr("onclick",'statusConfirm('+id+','+status+')');
    $("#statuschange").modal("show");
  }
  function statusConfirm(id,status){
    $("#statuschange").modal("hide");

    let token = $('meta[name="csrf-token"]').attr('content');

    /* set ajax request custom header */
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': token
      }
    });

    /* ajax */
    $.ajax({
      url : '{{ route('question.destroy','')}}'+"/"+id,
      type : 'post',
      dataType : 'JSON',
      data : {
        '_method' : 'DELETE',
        'status' : status
      },
      success : function(data){
        location.reload();
      },
      error : function(data){
        alert('error in delete data');
      }
    })
  }
</script>

@endpush