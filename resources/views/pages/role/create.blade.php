@extends('layouts.default')
@section('title')
    Tambah Role
@endsection
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
                        <small>Role</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Post</a></li>
                        <li class="breadcrumb-item active">Tambah Role</li>
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
                            <h3 class="card-title">Item Role</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('role.store') }}" method="post" class="bg-white shadow-sm p-3">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="control-label">Nama Role</label>
                                    <input  type="text"
                                    name="name" 
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                    <div class="text-muted">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Tambah</button>
                                    <a href="{{ route('role.index') }}" class="btn btn-info">Batal</a>
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