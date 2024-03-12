@extends('layouts.backend.master')
@section('title', 'Bảng điều khiển')
@section('content')
@php
$today = getdate();
$year = request('year') ? request('year') : $today['year'];
@endphp
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Mixed Widget 1-->
            <div class="card card-custom bg-gray-100 gutter-b card-stretch">
                <!--begin::Header-->
                <div class="card-header border-0 bg-danger py-5">
                    <h3 class="card-title font-weight-bolder text-white">Người dùng</h3>
                    <div class="card-toolbar">
                        <div class="dropdown dropdown-inline">
                            <a href="#" class="btn btn-transparent-white btn-sm font-weight-bolder dropdown-toggle px-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                <!--begin::Navigation-->
                                <ul class="navi navi-hover">

                                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-print"></i>
                                            </span>
                                            <span class="navi-text">Print</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-copy"></i>
                                            </span>
                                            <span class="navi-text">Copy</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <div wire:click="exportUser()" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-excel-o"></i>
                                            </span>
                                            <span class="navi-text">Excel</span>
                                        </div>
                                    </li>
                                    <li class="navi-item">
                                        <a href="#" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-text-o"></i>
                                            </span>
                                            <span class="navi-text">CSV</span>
                                        </a>
                                    </li>
                                    <li class="navi-item">
                                        <a href="{{route('admin.order.pdf')}}" class="navi-link">
                                            <span class="navi-icon">
                                                <i class="la la-file-pdf-o"></i>
                                            </span>
                                            <span class="navi-text">PDF</span>
                                        </a>
                                    </li>
                                </ul>
                                <!--end::Navigation-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body p-0 position-relative overflow-hidden">
                    <!--begin::Chart-->
                    <div style="height: 100px"></div>
                    <!--end::Chart-->
                    <!--begin::Stats-->
                    <div class="card-spacer mt-n25">
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
                                <h4 style="color: #999999;">{{$total_user}}</h4>
                                <a href="#" class="text-warning font-weight-bold font-size-h6">Tổng số người dùng</a>
                            </div>
                            <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
                            <h4 style="color: #999999;">{{$total_order}}</h4>
                                <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">Tổng số đơn đặt lịch</a>
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row m-0">
                            <div class="col bg-light-danger px-6 py-8 rounded-xl mr-7">
                            <h4 style="color: #999999;">{{$total_subject}}</h4>
                                <a href="#" class="text-danger font-weight-bold font-size-h6 mt-2">Tổng số môn tập</a>
                            </div>
                            <div class="col bg-light-success px-6 py-8 rounded-xl">
                            <h4 style="color: #999999;">{{$total_package}}</h4>
                                <a href="#" class="text-success font-weight-bold font-size-h6 mt-2">Tổng số gói tập</a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <div class="card card-custom card-stretch gutter-b">
                <div class="card card-custom card-stretch gutter-b">
											<!--begin::Header-->
											<div class="card-header h-auto border-0">
												<!--begin::Title-->
												<div class="card-title py-5">
													<h3 class="card-label">
														<span class="d-block text-dark font-weight-bolder">Số người đăng ký gói tập mới</span>
														<span class="d-block text-muted mt-2 font-size-sm">Dữ liệu phân tích năm {{$year}}</span>
													</h3>
												</div>
												<!--end::Title-->
												<!--begin::Toolbar-->
												<div class="card-toolbar">
													<div class="dropdown dropdown-inline">
														
														
															<!--begin::Naviigation-->
															<ul class="navi">
																<li class="navi-header font-weight-bold py-5">
																	<span class="font-size-lg">Chọn năm</span>
																</li>
                                                               <form action="" id="sb">
                                                               <select class="form-control" name="year" id="year">
																@for($i=$today['year']-5; $i<=$today['year']; $i++)
																	<option @if($year == $i) selected @else($year ) @endif value="{{$i}}">
                                                                    <span class="navi-text">{{$i}}</span>
                                                                    </option>
                                                                @endfor
                                                               </select>
                                                               <button  hidden></button>
                                                               </form>                                                             
															</ul>
															<!--end::Naviigation-->														
													</div>
												</div>
												<!--end::Toolbar-->
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body">
												<!--begin::Chart-->
												<div id="kt_charts_widget_1s_chart"></div>
												<!--end::Chart-->
											</div>
											<!--end::Body-->
										</div>
											<!--begin::Header-->
											<div class="card-header h-auto border-0">
												<!--begin::Title-->
												<div class="card-title py-5">
													<h3 class="card-label">
														<span class="d-block text-dark font-weight-bolder">Doanh thu</span>
														<span class="d-block text-muted mt-2 font-size-sm">Dữ liệu phân tích năm {{$year}}</span>
													</h3>
												</div>
												<!--end::Title-->
												
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body">
												<!--begin::Chart-->
												<div id="kt_charts_widget_1_chart"></div>
												<!--end::Chart-->
											</div>
											<!--end::Body-->
										</div>
                                       
                <!--end::Body-->
            </div>
            <!--end::Mixed Widget 1-->
        </div>
    </div>
    <!--end::Row-->
    <!--begin::Row-->
</div>
<!--end::Container-->
</div>
@endsection
@section('script')
<script>
      var _initChartsWidget1 = function () {
        var element = document.getElementById("kt_charts_widget_1_chart");

        if (!element) {
            return;
        }
        var options = {
            series: [{
                data: [{{st(1, $year)}}, {{st(2, $year)}}, {{st(3, $year)}}, {{st(4, $year)}}, {{st(5, $year)}}, {{st(6, $year)}},{{st(7, $year)}}, {{st(8, $year)}}, {{st(9, $year)}}, {{st(10, $year)}}, {{st(11, $year)}},{{st(12, $year)}}]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Otb','Nov','Dec'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return val + " vnđ"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['gray']['gray-300']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart = new ApexCharts(element, options);
        chart.render();


        var element2 = document.getElementById("kt_charts_widget_1s_chart");

        if (!element2) {
            return;
        }
        var options = {
            series: [{
                data: [{{sub(1, $year)}}, {{sub(2, $year)}}, {{sub(3, $year)}}, {{sub(4, $year)}}, {{sub(5, $year)}}, {{sub(6, $year)}},{{sub(7, $year)}}, {{sub(8, $year)}}, {{sub(9, $year)}}, {{sub(10, $year)}}, {{sub(11, $year)}},{{sub(12, $year)}}]
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: ['30%'],
                    endingShape: 'rounded'
                },
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Jan','Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Otb','Nov','Dec'],
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                        fontSize: '12px',
                        fontFamily: KTApp.getSettings()['font-family']
                    }
                }
            },
            fill: {
                opacity: 1
            },
            states: {
                normal: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                hover: {
                    filter: {
                        type: 'none',
                        value: 0
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: false,
                    filter: {
                        type: 'none',
                        value: 0
                    }
                }
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    fontFamily: KTApp.getSettings()['font-family']
                },
                y: {
                    formatter: function (val) {
                        return val + " đăng ký"
                    }
                }
            },
            colors: [KTApp.getSettings()['colors']['theme']['base']['success'], KTApp.getSettings()['colors']['gray']['gray-300']],
            grid: {
                borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                strokeDashArray: 4,
                yaxis: {
                    lines: {
                        show: true
                    }
                }
            }
        };

        var chart2 = new ApexCharts(element2, options);
        chart2.render();
    }

    $(function(){
        $('#year').on('change', function(){
            $('#sb').submit();
        })
    })
</script>
@endsection