@extends('layouts.backend.master')

@section('title', 'Quản lý người dùng')

@section('content')
@section('style')

<style>
    .star-style {
        background-repeat: no-repeat;
        width: 115%;
        height: 100%;
        margin-left: -7px;
    }

    .rating {
        position: absolute;
        top: -1px;
        left: 0;
    }

    .fa-star {
        margin: 5px;
        width: 20px;
        height: 10px;
    }

    .star-vote {
        width: 100px;
        height: 20px;
        position: relative;
        margin-right: 10px;
        margin-left: 10px;
    }

    .single_capt_left {
        font-size: 20px;
    }

    .alert {
        padding: 20px;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

@endsection
<div>

    <div class="card card-custom">
        @include('screens.backend._alert')
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Quản lý người dùng
                    <span class="d-block text-muted pt-2 font-size-sm">Danh sách</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Bảng lương</button>
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{route('admin.user.create')}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Thêm hội viên</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            {{-- {{ $page->links() }} --}}
            <!--begin: Search Form-->
            <form action="">
                <!--begin::Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input type="text" name="q" id="txtSearch" value="{{request('q')}}" class="form-control" value="{{ request()->query('q') ?: '' }}" placeholder="Nhập tên..." />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">OrderBy:</label>
                                        <select name="sort" class="form-control" id="kt_datatable_search_status">
                                            <option @if(request('sort', -1)=='idAsc' ) selected @endif value="idAsc">ID ASC</option>
                                            <option @if(request('sort', -1)=='idDesc' ) selected @endif value="idDesc">ID DESC</option>
                                            {{-- <option value="name">Name</option> --}}

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Status:</label>
                                        <select name="status" class="form-control" id="kt_datatable_search_type">
                                            <option value="">All</option>
                                            <option @if(request('status', -1)=='1' ) selected @endif value="1">On</option>
                                            <option @if(request('status', -1)=='0' ) selected @endif value="0">Off</option>


                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            {{-- <a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a> --}}
                            <button class="btn btn-light-primary px-6 font-weight-bold">Lọc</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
            <!--end: Datatable-->
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>Record ID</th>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Ảnh đại diện</th>
                        <th>Vai trò</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    

                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}} @if($user->getRoleNames() == '["coach"]') <div class="star-vote">
                                <div class="star-style rating" style="background-image: url({{asset('images/5star1.png')}}); width:{{(starPt($user->id)/5*100)*1.16}}%"></div>
                                <div class="star-style star_background" style="background-image: url({{asset('images/5star2.png')}});"></div>
                            </div> @endif</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <img src="{{$user->Avatar}}" width="200px" alt="">
                        </td>
                        <td class="show_role{{$user->id}}">
                            {{ $user->getRoleNames() }}
                        </td>
                        <td>
                            @if ($user->status == 1)
                            <span class="label label-inline label-light-primary font-weight-bold">Hiện</span>
                            @else
                            <span class="label label-inline label-light-danger font-weight-bold">Khoá</span>
                            @endif
                        </td>
                        <td nowrap="nowrap">
                            <a class="btn btn-light  btn-sm mr-2" id="change_status">
                                <i class="ki ki-reload text-warning"></i>
                            </a>
                        <button  
                            onclick="javascript:name_edit_role({{ $user }})"             
                                class="btn btn-light-primary px-6 font-weight-bold"
    
                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                >
                                <i class="flaticon2-gear text-primary"></i>
                            </button>
                             @if($user->getRoleNames() == '["coach"]')

                            <a href="{{route('admin.user.evaluate', $user->id)}}" title="Đánh giá" class="btn btn-light  btn-sm mr-2">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Flag.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" fill="#000000" />
                                            <path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg><!--end::Svg Icon--></span>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->

        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cấp quyền người dùng</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update_user_role">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Name</label>
                        <input type="email" disabled class="form-control name_edit_role" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <select id="name_role" class="form-select form-select-lg mb-3" aria-label="Default select example">
                        <option name="role" selected>Phân quyền</option>
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                    <div class="mb-3 form-check">
                        <input type="text" hidden id="update_role" name="id" id="">
                    </div>
                    <button type="button" data-id="" data-token="{{ csrf_token() }}" onclick="update_user_role('exampleModal','update_user_role')" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    function name_edit_role(item) {
        console.log(item.name);
        document.querySelector('.name_edit_role').value = item.name;
        document.getElementById('update_role').value = item.id;
        var id = document.getElementById('id');

    }

    function update_user_role(id_modal, id_form) {
        console.log(id_modal);

        // formData = new FormData(document.getElementById(id_form));
        // console.log(formData)
        var token = $(this).data("token");
        $.ajax({
            type: 'post',
            url: "{{route('admin.user.editRole')}}",
            data: {
                "_method": 'POST',
                "_token": token,
                "id": document.getElementById('update_role').value,
                "role": document.getElementById('name_role').value
            },
            // processData: false,
            // contentType: false,
            success: function(data) {
                console.log(document.getElementById('update_role').value);
                console.log(document.getElementById('name_role').value);
                id = document.getElementById('update_role').value;
                console.log(data['user']);
                $('.show_role' + id).html(`["${data['role']}"]`);
                Swal.fire(
                    'Good job!',
                    'Thanh cong',
                    'success'
                )
                modal = document.querySelector('.modal-backdrop')
                modal.classList.remove('show');
                modal.style.display = 'none'
                modal1 = document.getElementById(id_modal)
                modal1.classList.remove('show');
                modal1.style.display = 'none'
                // window.location.reload()
            },
            error: function(response) {
                // console.log(response.responseJSON.errors.name)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    // text: response.responseJSON.errors.name[0],
                    footer: '<a href="">Quay trở lại?</a>'
                })
            }
        });
        $.ajaxSetup({
            headers: {
                'csrftoken': '{{ csrf_token() }}'
            }
        });
    }


    $('#change_status').on('click', function() {
        console.log("quân");
        $package_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: "{{route('admin.user.editStatus')}}",
            data: {
                id: $package_id
            },

            success: function(data) {
                console.log("abc");
                if (data['result'] == true) {
                    console.log(data['package']);
                    console.log(data['result']);
                    document.querySelector(".set-coach").disabled = false;
                    // document.querySelector('#total_money').innerHTML = `${data['total_money']}`;
                } else {
                    // document.querySelector(".set-coach").innerHTML = `Gói tập này không có PT`;
                }
            }
        });
    })
</script>

@endsection