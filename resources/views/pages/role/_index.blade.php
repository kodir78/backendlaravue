@extends('layouts.default')
@section('title')
    Manajemen Role
@endsection
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
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Post</a></li>
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
                            <a id="add-button" title="Add New" class="btn btn-success" href="{{ route('role.create') }}"><i class="fa fa-plus-circle"></i> Add New</a>
                            <a href="#mymodal"
                            data-remote="#"
                            data-toggle="modal"
                            data-target="#mymodal"
                            data-title="Import Product"
                            class="btn btn-info">
                            Import
                        </a>
                        <div class="card-tools" style="padding:8px 0px">
                            <form action="{{ route('role.index') }}">
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
                        {{-- notifikasi form validasi --}}
                        @if ($errors->has('file'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                        @endif
                        
                        {{-- notifikasi sukses --}}
                        {{-- @if ($success = Session::get('sukses'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ $success }}</strong>
                        </div>
                        @endif --}}

                        @if (session('success'))
                            <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            {{ session('error') }}
                                </div>
                            @endif
                        <table class="table table-bordered">
                            <thead class="text-center">                  
                                <tr>
                                    <th style="width: 10px">#</th> 
                                    <td>Role</td>
                                    <td>Guard</td>
                                    <td>Created At</td>
                                    <th style="width: 130px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php $no = 1; @endphp
                                    @forelse ($items as $item)
                                     <td class="serial">{{ $no++  }}</td> 
                                     <td>{{ $item->name }}</td>
                                     <td>{{ $item->guard_name }}</td>
                                     <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a href="{{ route('role.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('role.destroy', $item->id) }}" 
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
                            {!! $items->links() !!}
                        </div>
                        <div class="float-right">
                            <small>Jumlah item user</small>
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