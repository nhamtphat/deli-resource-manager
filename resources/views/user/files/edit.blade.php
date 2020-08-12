@extends('user/layouts/master')
@section('head')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ secure_asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ secure_asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
    </section>

    <!-- Main content -->
    <section class="content">
    
    @if (count($errors) > 0) 
    @foreach ($errors->all() as $error) 
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-ban"></i> Thất bại!</h4> {!! $error !!}
      </div>
    @endforeach
    @endif
    
      <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chỉnh sửa tệp tin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{route('files.update', ['file' => $file->id])}}" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="_method" value="put" />
                {{csrf_field()}}
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Tên file:</label>
                    <input name="name" class="form-control" id="name"  value="{{ $file->name }}"  autofocus required>
                  </div>
                  <div class="form-group">
                    <label for="description">Mô tả file:</label>
                    <input name="description" type="text" class="form-control" id="description" value="{{ $file->description }}" required>
                  </div>
                  <div class="form-group">
                    <label>Chuyên mục:</label>
                    <select name="category_id" class="select2" data-placeholder="Chọn một chuyên mục" style="width: 100%;" required>
                      @foreach($categories as $data)
                      <option value="{{$data->id}}" @if($data->id == $file->category_id) selected @endif >{{$data->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File tải về</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="file" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Chọn file</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Xem trước</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input name="preview" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Chọn file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Lưu thay đổi</button>
                  <a onclick="history.go(-1);" class="btn">Quay lại</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@stop

@section('scripts')
<script src="{{ secure_asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ secure_asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
  $('.select2').select2({
      theme: 'bootstrap4'
    })
});
</script>
@stop