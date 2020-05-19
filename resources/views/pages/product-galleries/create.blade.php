@extends('layouts.default')
@push('after-style')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/backend/adminlte30/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="/assets/backend/adminlte30/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Jasny Bootstrap 4 -->
<link rel="stylesheet" href="/assets/backend/adminlte30/plugins/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">   
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
                        <small>Photo</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product-galleries.index') }}">Photo</a></li>
                        <li class="breadcrumb-item active">Tambah Photo</li>
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
                            <strong>Tambah Photo</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('product-galleries.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="products_id" class="control-label">Nama Barang</label>
                                    <select name="products_id"
                                    class="form-control select2bs4 @error('products_id') is-invalid @enderror">
                                    <option value="">Pilih Barang</option>
                                    @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                                @error('products_id')
                                <div class="text-muted">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type" class="control-label">Photo Barang</label><br>
                                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                    <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                        <img src="/assets/backend/adminlte30/dist/img/no_image.png"  alt="...">
                                    </div>
                                    <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select image</span>
                                        <span class="fileinput-exists">Change</span>
                                        <input type="file" class="@error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}" required></span>
                                        <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                    @error('image')
                                    <div class="text-muted">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="is_default" class="form-control-label">Photo Default</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input @error('is_default') is-invalid @enderror" value="1" type="radio" name="is_default">
                                    <label class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('is_default') is-invalid @enderror" value="0" type="radio" name="is_default" checked>
                                    <label class="form-check-label">Tidak</label>
                                </div>
                                @error('is_default')
                                <div class="text-muted">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">Tambah</button>
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
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>
@endpush