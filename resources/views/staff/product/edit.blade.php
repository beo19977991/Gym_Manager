@extends('staff.layouts.app', ['title' => 'EDit Product'])
@section('styles')
  <base href="{{asset(' ')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('css/plugins/summernote/summernote-bs4.css')}}">

@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa Sản Phẩm</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
              <li class="breadcrumb-item active">{{$staff_login->full_name}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sửa Sản Phẩm</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if(count($errors) >0)
                        <div class ="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}</br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                @endif
              <form action="{{route('staff-edit-product',['id'=>$product->id])}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="card-body">
                  <div class="form-group">
                    <label>Tên Loại Sản Phẩm</label>
                    <select class="form-control" name="product_type" id="product_type">
                      @foreach($product_types as $product_type)
                      <option 
                      @if($product->produt_type_id == $product_type->id)
                      {{"selected"}}
                      @endif
                      value="{{$product_type->id}}">{{$product_type->product_type_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Tên Sản Phẩm</label>
                    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Nhập Tên Sản Phẩm" value="{{$product->product_name}}">
                  </div>
                  <div class="form-group">
                    <label>Mô tả</Label>
                    <div class="mb-3">
                      <textarea class="textarea" name ="discription" placeholder="Nhập Mô Tả"
                        style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                        {!!$product->description!!}
                      </textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Giá</label>
                    <input type="text" name="price" class="form-control" id="price" placeholder="Nhập Giá Sản Phẩm" value="{{$product->price}}">
                  </div>
                  <div class="form-group">
                    <label>Số Lượng</label>
                    <input type="text" name="quantity" class="form-control" id="quantity" placeholder="Nhập Số Lượng Sản Phẩm" value="{{$product->quantity}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Ảnh</label>
                    <input class="form-control" type="file" name="photo" accept="image/*"  onchange="showMyImage(this)">
                    <img class="mt-2" style="width:150px;height:100px" src="upload/product/photo/{{$product->photo}}">
                  </div>
                  <div class="form-group">
                    <img id="thumbnil" style="width:20%; margin-top:10px;"  src="" alt="image"/>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
@section('scripts')
<!-- Summernote -->
<script src="css/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
  function showMyImage(fileInput) {
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {           
            var file = files[i];
            var imageType = /image.*/;     
            if (!file.type.match(imageType)) {
                continue;
            }           
            var img=document.getElementById("thumbnil");            
            img.file = file;    
            var reader = new FileReader();
            reader.onload = (function(aImg) { 
                return function(e) { 
                    aImg.src = e.target.result; 
                }; 
            })(img);
            reader.readAsDataURL(file);
        }    
    }
</script>
@endsection