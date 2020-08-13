@extends('user/layouts/master')
@section('head')
<link rel="stylesheet" href="{{secure_asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{secure_asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<style>
.preview-img {
  max-width: 500px;
}
.category-title {
  color: red;
  text-transform: uppercase;
}
.filename-title {
  color: blue;
}

@media only screen and (max-width: 768px) {
  .preview-img {
    max-width: 100%;
  }
  .description-title {
    margin-top: 20px;
  }
}
</style>
@stop

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Quản lý tệp</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Quản lý tệp</a></li>
                        <li class="breadcrumb-item active">Tệp</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Danh sách tệp tin</h3>
              <a href="{{ route('files.create') }}" class="btn btn-primary float-right">Thêm mới</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Xem trước</th>
                </tr>
                </thead>
                <tbody>
                @foreach($files as $file)
                <tr>
                  </td>
                  <td>
                  <div class="row">
                    <div class="col-lg-6">
                      <a href="{{ secure_asset('storage/files/'.$file->download_link) }}" >
                        <img src="{{ secure_asset('storage/previews/'.$file->preview_img) }}" class="preview-img"/>
                      </a>
                    </div>
                    <div class="col-lg-4">
                      <div class="description-title">
                        <b>
                          <span class="category-title">[{{ $file->category->name }}]</span>
                          <br>
                          <span class="filename-title">{{ $file->name }}:</span>
                        </b>
                        <br> {{ $file->description }}
                      </div>
                    </div>
                    <div class="col-lg-1">
                      <div class="btn-group">
                        <a href="{{ secure_asset('storage/files/'.$file->download_link) }}" class="btn btn-"><i class="fa fa-download" download></i></a>
                        <a href="{{ route('files.edit', ['file' => $file->id]) }}" class="btn btn-"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('files.destroy', ['file' => $file->id]) }}" method="post">
                          @csrf
                          <input type="hidden" name="_method" value="delete" />
                          <button type="submit" class="btn btn-" ><i class="fa fa-trash"></i></button>
                        </form>
                      </div>
                    </div>
                  </div>
                    
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop


@section('scripts')
<!-- DataTables -->
<script src="{{secure_asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{secure_asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{secure_asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{secure_asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
        // "order": false,
        "order": [[ 0, "asc" ]],
        "lengthMenu": [ 500 ],
        "bPaginate": false,
        "language": {
        	"sProcessing":   "Đang xử lý...",
        	"sLengthMenu":   "Xem _MENU_ mục",
        	"sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        	"sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        	"sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        	"sInfoFiltered": "(được lọc từ _MAX_ mục)",
        	"sInfoPostFix":  "",
        	"sSearch":       "Tìm:",
        	"sUrl":          "",
        	"oPaginate": {
        		"sFirst":    "Đầu",
        		"sPrevious": "Trước",
        		"sNext":     "Tiếp",
        		"sLast":     "Cuối"
        	}
        }
    });
  });

</script>
@stop