@extends('app')

@section('content')

    @if ($errors->has())
        @foreach ($errors->all() as $error)
        <div class='bg-danger alert'>{!! $error !!}</div>
        @endforeach
    @endif
    <div class="alert alert-warning">Info berikut ini belum data real !</div>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>Rp 7.240.000.000</h3>
            <p>Budgets</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>23.540.930 yards</h3>
            <p>Stock Levels</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{$kon}}</h3>
            <p>All Active Customers</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3>{{$lms['num']}}</h3>
            <p>Last monthly sales</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="/admin/penjualan/?mode=adv&tgl1={{$lms['tgl1']}}&tgl2={{$lms['tgl2']}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Line chart -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <i class="fa fa-bar-chart-o"></i>
          <h3 class="box-title">Yearly Sales (2018)</h3>
          <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <div id="line-chart" style="height: 300px;"></div>
        </div><!-- /.box-body-->
      </div><!-- /.box -->
    </div>
    

<!-- Script Area -->

    <!-- FLOT CHARTS -->
    <script src="{{ asset('/plugins/flot/jquery.flot.min.js') }}"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="{{ asset('/plugins/flot/jquery.flot.categories.min.js') }}"></script>

    <script type="text/javascript">
        /*
         * BAR CHART
         * ---------
         */
        $.get('/admin/beli',function(data){
          chartBeli(data);
        });

        function chartBeli(dt){
          var bar_data = {
            data: dt,
            color: "#3c8dbc"
          };
          $.plot("#line-chart", [bar_data], {
            grid: {
              borderWidth: 1,
              borderColor: "#f3f3f3",
              tickColor: "#f3f3f3"
            },
            series: {
              lines: {
                show: true,
                barWidth: 0.5,
                align: "center"
              }
            },
            xaxis: {
              mode: "categories",
              tickLength: 0
            }
          });
        }
        /* END BAR CHART */



    </script>
@endsection