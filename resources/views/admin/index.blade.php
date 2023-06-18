@include('admin.layouts.header')
@include('admin.layouts.navigation')
<?php
    $vi = json_decode($view, true);
    $arr_date = array();
    $arr_view = array();
    $ta_view = 0;
    foreach ($vi as $key => $val){
        $day = date('d M', strtotime($val['dates']));
        array_push($arr_date, $day);
        array_push($arr_view, $val['total']);
        $ta_view += intval($val['total']);
    }
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Online Visitors</h3>
                                <a class="float-right" data-toggle="modal" data-placement="bottom" data-target="#filter_home"><i class="fas fa-filter"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">{{$ta_view}}</span>
                                    <span>Visitors Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-muted">Last 10 days</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
<div class="modal fade" id="filter_home" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content card card-gray">
            <form method="POST" action="{{route('index.date_range')}}">
                @csrf
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-filter"></i>&nbsp;&nbsp;Filter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 pr-3 pl-3">
                            <div class="form-group">
                                <label class="mb-0">Date From/To</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                      <i class="far fa-calendar-alt"></i>
                                      </span>
                                    </div>
                                    <input type="text" class="float-right form-control" name="daterange" value="<?php echo date('m/d/Y'); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger float-right"><i class="fas fa-check-double"></i>&nbsp;&nbsp;Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('admin.layouts.footer')
<script>
    /* global Chart:false */
    $(function () {
        'use strict'
        var ticksStyle = {
            fontColor: '#495057',
            fontStyle: 'bold'
        }

        var mode = 'index'
        var intersect = true

        var $salesChart = $('#sales-chart')
        var $visitorsChart = $('#visitors-chart')
        var visitorsChart = new Chart($visitorsChart, {
            data: {
                labels: <?php echo  json_encode($arr_date); ?>,
                datasets: [{
                    type: 'line',
                    data: <?php echo  json_encode($arr_view); ?>,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    pointBorderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                    fill: false
                },
                    {
                        type: 'line',
                        // data: [60, 80, 70, 67, 80, 77, 100],
                        backgroundColor: 'tansparent',
                        borderColor: '#ced4da',
                        pointBorderColor: '#ced4da',
                        pointBackgroundColor: '#ced4da',
                        fill: false
                    }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    mode: mode,
                    intersect: intersect
                },
                hover: {
                    mode: mode,
                    intersect: intersect
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        // display: false,
                        gridLines: {
                            display: true,
                            lineWidth: '4px',
                            color: 'rgba(0, 0, 0, .2)',
                            zeroLineColor: 'transparent'
                        },
                        ticks: $.extend({
                            beginAtZero: true,
                            suggestedMax: <?php if (count($vi) > 0){
                                echo max($arr_view);
                            } ?>
                        }, ticksStyle)
                    }],
                    xAxes: [{
                        display: true,
                        gridLines: {
                            display: false
                        },
                        ticks: ticksStyle
                    }]
                }
            }
        })
    })
    // lgtm [js/unused-local-variable]
</script>
