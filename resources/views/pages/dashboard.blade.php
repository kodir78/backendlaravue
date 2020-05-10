@extends('layouts.default')
@section("title") Home Dashboard @endsection
@push('before-style')

@endpush
@push('after-style')

@endpush
<!-- Start Content -->
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $income }}</h3>
                
                <p>Pendapatan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-6 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $sales }}</h3>
                
                <p>Penjualan</p>
              </div>
              <div class="icon">
                <i class="fas fa-cart-plus fa-lg mr-2"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7">
           
            <!-- Daftar Penjualan -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Daftar Penjualan
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Nomor</th>
                      <th>Total Transaksi</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse ($items as $item)
                    <tr>
                      <td>{{ $item->id }}</td>
                      <td>{{ $item->title }}</td>
                      <td>{{ $item->email }}</td>
                      <td>{{ $item->number }}</td>
                      <td>${{ $item->transaction_total }}</td>
                      <td>
                        @if($item->transaction_status == 'PENDING')
                        <span class="badge badge-warning">
                          @elseif($item->transaction_status == 'SUCCESS')
                          <span class="badge badge-success">
                            @elseif($item->transaction_status == 'FAILED')
                            <span class="badge badge-danger">
                              @else
                              <span>
                                @endif
                                {{ $item->transaction_status }}
                              </span>
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
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 chartPie">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Grafik Penjualan
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>   
                  </div>  
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection
  
@push('after-script')
<script>
  jQuery(document).ready(function($) {

    'use strict'
  
    // Make the dashboard widgets sortable Using jquery UI
    $('.chartPie').sortable({
      placeholder         : 'sort-highlight',
      connectWith         : '.chartPie',
      handle              : '.card-header',
      forcePlaceholderSize: true,
      zIndex              : 999999
    })
    $('.chartPie .card-header').css('cursor', 'move')
  
    /* Chart.js Charts */
    // Donut Chart
    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
    var pieData        = {
      labels: [
        'Pending', 
        'Failed', 
        'Success',
      ],
      datasets: [
        {
          data: [
            {{ $pie['pending']}},
            {{ $pie['failed']}},
            {{ $pie['success']}},
            ],
          backgroundColor : ['#f39c12', '#f56954', '#00a65a'],
        }
      ]
    }
    var pieOptions = {
      legend: {
        display: true
      },
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    });
  
  })
</script>
@endpush

