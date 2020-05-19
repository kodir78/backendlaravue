@extends('layouts.default')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Daftar 
                        <small>Transaksi Masuk</small>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('transactions.index') }}">Post</a></li>
                        <li class="breadcrumb-item active">Daftar Transaksi</li>
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
                            <strong>Ubah Transaksi</strong>
                            <small>{{ $item->uuid }}</small>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{ route('transactions.update', $item->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="form-control-label">Nama Pemesan</label>
                                    <input  type="text"
                                    name="name" 
                                    value="{{ old('name') ? old('name') : $item->name }}" 
                                    class="form-control @error('name') is-invalid @enderror"/>
                                    @error('name') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email" class="form-control-label">Email</label>
                                    <input  type="email"
                                    name="email" 
                                    value="{{ old('email') ? old('email') : $item->email }}" 
                                    class="form-control @error('email') is-invalid @enderror"/>
                                    @error('email') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="number" class="form-control-label">Nomor HP</label>
                                    <input  type="text"
                                    name="number" 
                                    value="{{ old('number') ? old('number') : $item->number }}" 
                                    class="form-control @error('number') is-invalid @enderror"/>
                                    @error('number') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address" class="form-control-label">Alamat Pemesan</label>
                                    <input  type="text"
                                    name="address" 
                                    value="{{ old('address') ? old('address') : $item->address }}" 
                                    class="form-control @error('address') is-invalid @enderror"/>
                                    @error('address') <div class="text-muted">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">
                                        Ubah Transaksi
                                    </button>
                                    <a href="{{ route('transactions.index') }}" class="btn btn-info">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection