@extends('layouts.default')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Daftar 
                        <small>Barang</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Post</a></li>
                        <li class="breadcrumb-item active">Daftar Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a id="add-button" title="Add New" class="btn btn-success" href="{{ route('products.create') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                            <a href="#mymodal"
                                          data-remote="#"
                                          data-toggle="modal"
                                          data-target="#mymodal"
                                          data-title="Import Product"
                                          class="btn btn-info">
                                          Import
                                        </a>
                            <div class="card-tools" style="padding:8px 0px">
                                <form action="{{ route('products.index') }}">
                                    <div class="input-group input-group-sm" style="width: 250px;">
                                        <input type="text" name="keyword" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead class="text-center">                  
                                    <tr>
                                        {{--  <th style="width: 10px">#</th>  --}}
                                        <th>Nama Barang</th>
                                        <th>Tipe</th>
                                        <th>Harga Satuan</th>
                                        <th>Quantity</th>
                                        <th style="width: 130px">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse ($items as $item)
                                        {{--  <td class="serial">{{ $item->id }}</td>  --}}
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->type }} </td>
                                        <td class="text-right">{{ $item->price }}</td>
                                        <td class="text-right">{{ $item->quantity }}</td>
                                        <td>
                                            <a href="{{ route('products.gallery', $item->id) }}" class="btn btn-info btn-sm">
                                                <i class="far fa-image"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $item->id) }}" 
                                                method="post" 
                                                class="d-inline">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center" style="padding: 10px">Data tidak tersedia</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <div class="float-left">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                            <div class="float-right">
                                <small>Jumlah item barang</small>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
        <!-- ./row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@push('after-script')
{{--  <script>
  jQuery(document).ready(function($){
      $('#mymodal').on('show.bs.modal', function(e){
          var button = $(e.relatedTarget);
          var modal = $(this);
          
          modal.find('.modal-body').load(button.data("remote"));
          modal.find('.modal-title').html(button.data("title"));
      });
  });
</script>  --}}

<div class="modal fade" id="mymodal">
  <div class="modal-dialog">
    <form method="post" action="/products/import_excel" enctype="multipart/form-data">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
            </div>
            <div class="modal-body">
                <label>Pilih file excel</label>
                <div class="form-group">
                    <input type="file" name="file" required="required">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </div>
    </form>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endpush
@endsection