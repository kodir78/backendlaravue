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
                            {{--  <a id="add-button" title="Add New" class="btn btn-success" href="{{ route('transactions.create') }}"><i class="fa fa-plus-circle"></i> Add New</a>  --}}
                            <div class="card-tools" style="padding:8px 0px">
                                <form action="{{ route('transactions.index') }}">
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
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Nomor</th>
                                    <th>Total Transaksi</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @forelse ($items as $item)
                                    <tr>
                                      <td>{{ $item->id }}</td>
                                      <td>{{ $item->name }}</td>
                                      <td>{{ $item->email }}</td>
                                      <td>{{ $item->number }}</td>
                                      <td>${{ $item->transaction_total }}</td>
                                      <td>
                                        @if($item->transaction_status == 'PENDING')
                                          <span class="badge badge-info">
                                        @elseif($item->transaction_status == 'SUCCESS')
                                          <span class="badge badge-success">
                                        @elseif($item->transaction_status == 'FAILED')
                                          <span class="badge badge-warning">
                                        @else
                                          <span>
                                        @endif
                                          {{ $item->transaction_status }}
                                          </span>
                                      </td>
                                      <td>
                                        @if($item->transaction_status == 'PENDING')
                                          <a href="{{ route('transactions.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-sm">
                                            <i class="fa fa-check"></i>
                                          </a>
                                          <a href="{{ route('transactions.status', $item->id) }}?status=FAILED" class="btn btn-warning btn-sm">
                                            <i class="fa fa-times"></i>
                                          </a>
                                        @endif
                                        <a href="#mymodal"
                                          data-remote="{{ route('transactions.show', $item->id) }}"
                                          data-toggle="modal"
                                          data-target="#mymodal"
                                          data-title="Detail Transaksi {{ $item->uuid }}"
                                          class="btn btn-info btn-sm">
                                          <i class="fa fa-eye"></i>
                                        </a>
                                        <a href="{{ route('transactions.edit', $item->id) }}" class="btn btn-primary btn-sm">
                                          <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('transactions.destroy', $item->id) }}" 
                                              method="post" 
                                              class="d-inline">
                                          @csrf
                                          @method('delete')
                                          <button class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                          </button>
                                        </form>
                                      </td>
                                    </tr>
                                  @empty
                                      <tr>
                                        <td colspan="6" class="text-center p-5">
                                          Data tidak tersedia
                                        </td>
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
@push('after-script')')
<script>
  jQuery(document).ready(function($){
      $('#mymodal').on('show.bs.modal', function(e){
          var button = $(e.relatedTarget);
          var modal = $(this);
          
          modal.find('.modal-body').load(button.data("remote"));
          modal.find('.modal-title').html(button.data("title"));
      });
  });
</script>

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title"></h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <i class="fa fa-spinner fa-spin"></i>
          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endpush
@endsection