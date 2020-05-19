@extends('layouts.default')
@push('after-style')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/backend/adminlte30/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/backend/adminlte30/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Jasny Bootstrap 4 -->
<link rel="stylesheet" href="/assets/backend/adminlte30/plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">   
<!-- summernote -->
<link rel="stylesheet" href="/assets/backend/adminlte30/plugins/summernote/summernote-bs4.css">
@endpush
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Tambah
                        <small>Barang</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Post</a></li>
                        <li class="breadcrumb-item active">Tambah Barang</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <strong>Ubah Barang</strong> 
                            <small>{{ $item->title }}</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('products.update', $item->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label">Nama Barang</label>
                                    <input  type="text"
                                    name="name" 
                                    value="{{ old('name') ? old('name') : $item->name}}" //Tenari function
                                    class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="text-muted">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type" class="control-label">Tipe Barang</label>
                                    <input  type="text" 
                                    name="type" 
                                    value="{{ old('type') ? old('type') : $item->type }}"
                                    class="form-control @error('type') is-invalid @enderror">
                                    @error('type')
                                    <div class="text-muted">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Deskripsi</label>
                                    <textarea name="description"
                                    class=" form-control @error('description') is-invalid @enderror" >{{ old('description') ? old('description') : $item->description }}</textarea>
                                    @error('description')
                                    <div class="text-muted">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="price" class="control-label">Harga</label>
                                    <input  type="number" 
                                    name="price" 
                                    value="{{ old('price') ? old('price') : $item->price }}"
                                    class="form-control @error('price') is-invalid @enderror">
                                    @error('price')
                                    <div class="text-muted">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="quantity" class="control-label">Quantity</label>
                                    <input  type="number" 
                                    name="quantity" 
                                    value="{{ old('quantity') ? old('quantity') : $item->quantity }}"
                                    class="form-control @error('quantity') is-invalid @enderror">
                                    @error('quantity')
                                    <div class="text-muted">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Update</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-info">Batal</a>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('after-script')
<!-- Select2 -->
<script src="/assets/backend/adminlte30/plugins/select2/js/select2.full.min.js"></script>
<!-- Jasny Bootstrap 4 -->
<script src="/assets/backend/adminlte30/plugins/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
<!-- Summernote Bootstrap 4 -->
<script src="/assets/backend/adminlte30/plugins/summernote/summernote-bs4.min.js"></script>   
<script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()
            
            
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            
            $('.summernote').summernote({
                height: "100px",
            });
        });
</script>
@endpush