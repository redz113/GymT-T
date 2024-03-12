
@extends('layouts.backend.master')

@section('title', 'Quản lý đơn đặt')
@section('style')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="/backend/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="/backend/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/backend/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="backend/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="/backend/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="/backend/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="/backend/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="/backend/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="backend/media/logos/favicon.ico" />
    <style>
        .select2-container--default .select2-selection--single{
            height: 40px;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
    </style>
@endsection
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-2 mr-5">Đơn đặt</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Thanh toán</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="" class="text-muted">Kết thúc</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-light font-weight-bold btn-sm">Actions</a>
                <!--end::Actions-->
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-success svg-icon-2x">
                            <!--begin::Svg Icon | path:backend/media/svg/icons/Files/File-plus.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 m-0">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover">
                            <li class="navi-header font-weight-bold py-4">
                                <span class="font-size-lg">Choose Label:</span>
                                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
                            </li>
                            <li class="navi-separator mb-3 opacity-70"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-success">Customer</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-danger">Partner</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-warning">Suplier</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-primary">Member</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-text">
                                        <span class="label label-xl label-inline label-light-dark">Staff</span>
                                    </span>
                                </a>
                            </li>
                            <li class="navi-separator mt-3 opacity-70"></li>
                            <li class="navi-footer py-4">
                                <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                                <i class="ki ki-plus icon-sm"></i>Add new</a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin: Wizard-->
                    <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
                        <!--begin: Wizard Nav-->
                        <div class="wizard-nav">
                            <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>1.</span>Chọn gói tập</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>2.</span> Chi tiết</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>3.</span>Thanh toán và kết thúc</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <!-- <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>4.</span>Delivery Address</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div> -->
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 5 Nav-->
                                <!-- <div class="wizard-step" data-wizard-type="step">
                                    <div class="wizard-label">
                                        <h3 class="wizard-title">
                                        <span>5</span>Review and Submit</h3>
                                        <div class="wizard-bar"></div>
                                    </div>
                                </div> -->
                                <!--end::Wizard Step 5 Nav-->
                            </div>
                        </div>
                        <!--end: Wizard Nav-->
                        <!--begin: Wizard Body-->
                        <div class="row justify-content-center py-10 px-8 py-lg-12 px-lg-10">
                            <div class="col-xl-12 col-xxl-7">
                                <!--begin: Wizard Form-->
                                <form  action="{{route('admin.order.postOrder')}}" method="POST" class="form" id="kt_form">
                                    {{-- <form  action="{{route('admin.order.momoPayment')}}" method="POST" class="form" id="kt_form"> --}}

                                    <!--begin: Wizard Step 1-->
                                    @csrf
                                    @method('POST')
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <h4 class="mb-10 font-weight-bold text-dark">Chọn gói tập</h4>
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            {{-- <input type="text" class="form-control" name="address1" placeholder="Address Line 1" value="Address Line 1" />
                                            <span class="form-text text-muted">Please enter your Address.</span> --}}
                                            <div class="col-sm-12">
                                                {{-- <select id="add_package" placeholder="" class="form-control select2" id="kt_select2_1" > --}}
                                                   <select name="package_id" style="height: 50px"  class="form-control select2 is-invalid add_package" id="kt_select2_1_validate" >
                                                   <option value=""><strong>Chọn gói tập</strong></option>
                                                   @foreach ($packages as $package)
                                                       <option  value="{{$package->id}}">{{$package->package_name}}  </option>  
                                                   @endforeach  
                                                      
                                                </select>
                                                @error('package_id')
                                                   <span class="text-danger">{{ $message }}</span>    
                                               @enderror
                                               </div>
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Input-->
                                        
                                    </div>
                                    <!--end: Wizard Step 1-->
                                    <!--begin: Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Enter the details of your delivery</h4>
                                        <!--begin::Input-->
                                        <div class="form-group">
                                            <label class="col-form-label">Choose a user</label>
                                            <div style="width: 100%;" class="col-sm-12">
                                             <select name="user_id[]" multiple style="width: 100%;" class="form-control select2" id="kt_select2_11" multiple name="param">
                                              <optgroup label="Choose a user">
                                              
                                                @foreach ($users as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                              </optgroup>
                                             </select>
                                             @error('user_id')
                                                <span class="text-danger">{{ $message }}</span>    
                                            @enderror
                                             </select>
                                            </div>
                                        </div>
                                        <div id="time_package" style="display: none;" class="form-group">
                                            <label >Choose a shift</label>
                                            <div style="width: 100%;" class="col-sm-12">
                                                <select name="time_id" style="width: 100%;" class="form-control select2 is-invalid" id="kt_select2_2_validate" >
                                
                                                    <option style="display: none;" value=""></option>
                                                    @foreach ($times as $time)
                                                        <option value="{{$time->id}}">{{$time->time_name}}</option>  
                                                    @endforeach 
                                                
                                                </select>
                                                @error('time_id')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="coach_package" style="display: none;" class="form-group  set-coach" >
                                            <label >Choose a coach</label>
                                            <div class="col-sm-12">
                                                <select style="width: 100%;" name="pt_id" class="form-control select2 is-invalid" id="kt_select2_3_validate" >
                                                    <option style="display: none;" value=""></option>
                                                    <option value="0">No coach</option>
                                                    @foreach ($coachs as $coach)
                                                        <option value="{{$coach->id}}">{{$coach->name}}</option>  
                                                    @endforeach 
                                                </select> 
                                                @error('pt_id')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="col-form-label">Chọn ngày kích hoạt</label>
                                                <div class="col-sm-12">
                                                    <div class="input-group date" >
                                                        <input type="date" class="form-control" name="activate_day" placeholder="Select time" id="kt_datetimepicker_7"/>
                                                        <div class="input-group-append">
                                                        <span class="input-group-text">
                                                        <i class="la la-calendar glyphicon-th"></i>
                                                        </span>
                                                        </div>
                                            </div>
                                                @error('activate_day')
                                                 <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div> 

                                        <div id="weekday_package" style="display: none;" class="form-group">
                                            <label class="col-form-label">Chọn thứ tập PT</label>
                                            <div class="col-sm-12">
                                             <select name="weekday_name[]" style="width: 100%;" class="form-control select2" id="kt_select2_9"  multiple>
                                              <option label="Label"></option>
                                              <optgroup label="Chọn 3 ngày">
                                                @foreach ($weekdays as $weekday)
                                                    <option value="{{$weekday->weekday_name}}">{{$weekday->weekday_name}}</option>  
                                                @endforeach 
                                              </optgroup>
                                
                                             </select>
                                                @error('weekday_name')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                            </div>
                                        </div>

                                        <div id="method_pm"  class="form-group">
                                            <label class="col-form-label">Chọn phương thức thanh toán</label>
                                            <div class=" col-sm-12">
                                                <select name="payment_method" style="width: 100%;" class="form-control select2" id="kt_select2_10" name="param">
                                                    <option value="1">Thanh toán trực tiếp</option>
                                                    <option value="2">Thanh toán qua VN Pay</option>
                                                </select>
                                                    
                                            </div>
                                        </div>
                                        <!--end::Input-->
                                        <!--begin::Input-->
                                        {{-- <div class="form-group">
                                            <label>Package Weight in KG</label>
                                            <input type="text" class="form-control" name="weight" placeholder="Package Weight" value="25" />
                                            <span class="form-text text-muted">Please enter your Package Weight in KG.</span>
                                        </div>
                                        <!--end::Input-->
                                        <div class="form-text">Package Dimensions</div>
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Package Width in CM</label>
                                                    <input type="text" class="form-control" name="width" placeholder="Package Width" value="110" />
                                                    <span class="form-text text-muted">Please enter your Package Width in CM.</span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Package Height in CM</label>
                                                    <input type="text" class="form-control" name="height" placeholder="Package Height" value="90" />
                                                    <span class="form-text text-muted">Please enter your Package Height in CM.</span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <div class="col-xl-4">
                                                <!--begin::Input-->
                                                <div class="form-group">
                                                    <label>Package Length in CM</label>
                                                    <input type="text" class="form-control" name="packagelength" placeholder="Package Length" value="150" />
                                                    <span class="form-text text-muted">Please enter your Package Length in CM.</span>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                        </div> --}}
                                    </div>
                                    <!--end: Wizard Step 2-->
                                    <!--begin: Wizard Step 3-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Payment and submit</h4>
                                        <!--begin::Select-->
                                        <div class="form-group">
                                        <label class="col-form-label">Enter coupon ( if have )</label>
                                            <div style="display: flex" class="col-10">
                                                <input disabled name="discount_code" style="width: 80%" class="form-control discount_code @error('discount_title') is-invalid @enderror" name="discount_title"  type="text" value="{{ old('discount_code') }}" placeholder="title" id="example-text-input "/>
                                                @error('discount_title')
                                                    <span class="text-danger">{{ $message }}</span>    
                                                @enderror
                                                <button disabled style="margin-left: 10px" type="button" class="btn btn-outline-info button_discount">Áp dụng</button>
                                            </div>
                                            
                                        </div>
                                        <!--end::Select-->
                                        <!--begin::Select-->
                                        
                                        <!--end::Select-->
                                        <!--begin::Select-->
                                        <div class="form-group">
                                            <label>Total money</label>
                                            <div class=" col-lg-4 col-md-9 col-sm-12">
                                                <strong id="total_money" style="color: red"></strong>

                                            </div>
                                        </div>
                                        <!--end::Select-->
                                        <button name="direct_trading" onclick="return confirm('Thanh toán và tạo ra hợp đồng luôn ?');"
                                         class="btn btn-success font-weight-bold text-uppercase" >Payment</button>
                                        {{-- <button name="payUrl" class="btn btn-success font-weight-bold text-uppercase" >Thanh toán VNPAY</button> --}}
                                        
                                    </div>
                                    <!--end: Wizard Step 3-->
                                    <!--begin: Wizard Step 4-->
                                    <!-- <div class="pb-5" data-wizard-type="step-content">
                                        <h4 class="mb-10 font-weight-bold text-dark">Setup Your Delivery Location</h4>
                                        <div class="my-5">
                                          
                                            <div class="form-group">
                                                <label>Address Line 1</label>
                                                <input type="text" class="form-control" name="locaddress1" placeholder="Address Line 1" value="Address Line 1" />
                                                <span class="form-text text-muted">Please enter your Address.</span>
                                            </div>
                                          
                                            
                                            <div class="form-group">
                                                <label>Address Line 2</label>
                                                <input type="text" class="form-control" name="locaddress2" placeholder="Address Line 2" value="Address Line 2" />
                                                <span class="form-text text-muted">Please enter your Address.</span>
                                            </div>
                                           
                                            <div class="row">
                                                <div class="col-xl-6">
                                                
                                                    <div class="form-group">
                                                        <label>Postcode</label>
                                                        <input type="text" class="form-control" name="locpostcode" placeholder="Postcode" value="3072" />
                                                        <span class="form-text text-muted">Please enter your Postcode.</span>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-xl-6">
                                                    
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" name="loccity" placeholder="City" value="Preston" />
                                                        <span class="form-text text-muted">Please enter your City.</span>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-6">
                                                   
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" class="form-control" name="locstate" placeholder="State" value="VIC" />
                                                        <span class="form-text text-muted">Please enter your State.</span>
                                                    </div>
                                                    
                                                   
                                                </div>
                                                <div class="col-xl-6">
                                                   
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select name="loccountry" class="form-control">
                                                            <option value="">Select</option>
                                                            <option value="AF">Afghanistan</option>
                                                            <option value="AX">Åland Islands</option>
                                                            <option value="AL">Albania</option>
                                                            <option value="DZ">Algeria</option>
                                                            <option value="AS">American Samoa</option>
                                                            <option value="AD">Andorra</option>
                                                            
                                                            <option value="UZ">Uzbekistan</option>
                                                            <option value="VU">Vanuatu</option>
                                                            <option value="VE">Venezuela, Bolivarian Republic of</option>
                                                            <option value="VN">Viet Nam</option>
                                                            <option value="VG">Virgin Islands, British</option>
                                                            <option value="VI">Virgin Islands, U.S.</option>
                                                            <option value="WF">Wallis and Futuna</option>
                                                            <option value="EH">Western Sahara</option>
                                                            <option value="YE">Yemen</option>
                                                            <option value="ZM">Zambia</option>
                                                            <option value="ZW">Zimbabwe</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!--end: Wizard Step 4-->
                                    <!--begin: Wizard Step 5-->
                                   <!--  <div class="pb-5" data-wizard-type="step-content">
                                       
                                        <h4 class="mb-10 font-weight-bold text-dark">Review your Details and Submit</h4>
                                        <h6 class="font-weight-bolder mb-3">Current Address:</h6>
                                        <div class="text-dark-50 line-height-lg">
                                            <div>Address Line 1</div>
                                            <div>Address Line 2</div>
                                            <div>Melbourne 3000, VIC, Australia</div>
                                        </div>
                                        <div class="separator separator-dashed my-5"></div>
                                        
                                        <h6 class="font-weight-bolder mb-3">Delivery Details:</h6>
                                        <div class="text-dark-50 line-height-lg">
                                            <div>Package: Complete Workstation (Monitor, Computer, Keyboard &amp; Mouse)</div>
                                            <div>Weight: 25kg</div>
                                            <div>Dimensions: 110cm (w) x 90cm (h) x 150cm (L)</div>
                                        </div>
                                        <div class="separator separator-dashed my-5"></div>
                                        
                                        <h6 class="font-weight-bolder mb-3">Delivery Service Type:</h6>
                                        <div class="text-dark-50 line-height-lg">
                                            <div>Overnight Delivery with Regular Packaging</div>
                                            <div>Preferred Morning (8:00AM - 11:00AM) Delivery</div>
                                        </div>
                                        <div class="separator separator-dashed my-5"></div>
                                       
                                        <h6 class="font-weight-bolder mb-3">Delivery Address:</h6>
                                        <div class="text-dark-50 line-height-lg">
                                            <div>Address Line 1</div>
                                            <div>Address Line 2</div>
                                            <div>Preston 3072, VIC, Australia</div>
                                        </div>
                                       
                                        
                                    </div> -->
                                    
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div class="mr-2">
                                            <button class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
                                        </div>
                                        <div>
                                            <button class="btn btn-success font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-submit">Submit</button>
                                            <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4" data-wizard-type="action-next">Next Step</button>
                                        </div>
                                    </div>
                                   
                                </form>
                                <!--end: Wizard Form-->
                            </div>
                        </div>
                        <!--end: Wizard Body-->
                    </div>
                    <!--end: Wizard-->
                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

   
    
@endsection

@section('script')
    <script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="/backend/plugins/global/plugins.bundle.js"></script>
    <script src="/backend/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="/backend/js/scripts.bundle.js"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="/backend/js/pages/custom/wizard/wizard-3.js"></script>


<script>

    $('.add_package').on('change',function(){
        console.log("quân");
            $package_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.order.setPackage')}}",
                data:{
                    id: $package_id
                },
                
                success:function(data){
                console.log("abc");
                if(data['result'] == 1){
                    console.log(data['package'].price);
                    console.log(data['result']);
                    $('.discount_code').attr('disabled', false);
                    $('.button_discount').attr('disabled', false);
                    document.querySelector('#coach_package').style.display='block';
                    document.querySelector('#weekday_package').style.display='block';
                    document.querySelector('#time_package').style.display='block';
    
                    // document.querySelector('#method_pm').classList.add('method_pm_block');
                    // document.querySelector('#method_pm').style.display='flex';
                    // document.querySelector('#method_pm').style.visibility= 'visible';
                    // document.querySelector('#method_pm').style.transform='translate(0)';
                    // document.querySelector('#method_pm').style.transition='.5s';
                    // document.querySelector('#method_pm').style.opacity='1';
                    // document.querySelector('#btn_disabled').classList.remove("disabled");
                    document.querySelector('#total_money').innerHTML = `${data['package'].price}`;
                }
                if(data['result'] == 0){
                    console.log("bằng 0");
                    $('.discount_code').attr('disabled', false);
                    $('.button_discount').attr('disabled', false);
                    document.querySelector('#coach_package').style.display='none';
                    document.querySelector('#weekday_package').style.display='none';
                    document.querySelector('#time_package').style.display='none';
                    // document.querySelector('#btn_disabled').classList.remove("disabled");
                    document.querySelector('#total_money').innerHTML = `${data['package'].price}`;
    
                }
                }
            });
        });
    
    
        $('.add_package').on('change',function(){
        console.log("quân");
            $package_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.order.setCoach')}}",
                data:{
                    id: $package_id
                },
                
                success:function(data){
                console.log("abc");
                if(data['result'] == true){
                    console.log(data['package']);
                    console.log(data['result']);
                    document.querySelector(".set-coach").disabled = false;
                    // document.querySelector('#total_money').innerHTML = `${data['total_money']}`;
                }
                else{
                    // document.querySelector(".set-coach").innerHTML = `Gói tập này không có PT`;
                }
                }
            });
        })
    
        $('.button_discount').on('click',function(){
            var package_id = $('#add_package').val();
            console.log("quân");
            var discount_code = $('.discount_code').val();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.order.setTotalMoney')}}",
                data:{
                    package_id: package_id,
                    discount_code: discount_code
                },
                
                success:function(data){
                console.log("abc");
                console.log(data);
                if(data['result'] == true){
                    
                    // console.log(data['package']);
                    // console.log(data['result']);
                    // document.querySelector(".set-coach").disabled = false;
                    document.querySelector('#total_money').innerHTML = `${data['total_money']}`;
                }
                else{
                    // document.querySelector(".set-coach").innerHTML = `Gói tập này không có PT`;
                }
                }
            });
        })
    
    
    
    </script>
    
<script>
    $(document).ready(function(){
        $('.select2').select2()
    })


    // Class definition
var KTSelect2 = function() {
 // Private functions
    var demos = function() {
    // basic
    $('#kt_select2_1_validate').select2({
        placeholder: "Choose a package"
    });

    // nested
    $('#kt_select2_2_validate').select2({
        placeholder: "Choose a shift"
    });

    // multi select
    $('#kt_select2_3_validate').select2({
        placeholder: "Choose a coach"
        });
    }

    // Public functions
    return {
        init: function() {
        demos();
        }
    };
    }();

    // Initialization
    jQuery(document).ready(function() {
        KTSelect2.init();
    });







</script>
@endsection