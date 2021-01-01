@extends('layout')
@section('title', 'Dashboard')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link href="{{ asset('custom/js/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('custom/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('lib/select2/dist/css/select2.css') }}">
@endsection

@section('content')

    <div class="kt-portlet__body">
        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="kt-searchbar">
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path
                                            d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                        <path
                                            d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                            fill="#000000" fill-rule="nonzero"></path>
                                    </g>
                                </svg>
                            </span>
                            </div>
                            <select class="search-people form-control search-input" name="" id="search-people"></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body">
        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="row align-items-center">
                        <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-input-icon kt-input-icon--left">
                                <input type="text" class="form-control" placeholder="Search" id="search">
                                <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                        <span><i class="la la-search"></i></span>
                                    </span>
                            </div>
                        </div>
                        <div class="col-md-3 kt-margin-b-20-tablet-and-mobile">
                            <div class="kt-form__group kt-form__group--inline w-100">
                                <div class="kt-form__control">
                                    <select class="form-control bootstrap-select" id="kt_form_status">
                                        <option selected="selected" value="{{ \App\Models\Relationship::APPROVED }}">Friends</option>
                                        <option value="{{ \App\Models\Relationship::REJECTED }}">Rejected</option>
                                        <option value="{{ \App\Models\Relationship::PENDING }}">Pending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet__body kt-padding-t-0">
        <div class="users-datatable" id="users-datatable" data-url="{{ route('users.data') }}" ></div>
    </div>

@endsection

@section('custom_scripts')
    <script src="{{ asset('lib/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('lib/block-ui/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('lib/js-cookie/src/js.cookie.js') }}"></script>
    <script src="{{ asset('lib/sticky-js/dist/sticky.min.js') }}"></script>
    <script>var KTAppOptions = {"colors":{"state":{"brand":"#5d78ff","dark":"#282a3c","light":"#ffffff","primary":"#5867dd","success":"#34bfa3","info":"#36a3f7","warning":"#ffb822","danger":"#fd3995"},"base":{"label":["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],"shape":["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};</script>
    <script src="{{ asset('custom/js/scripts.bundle.js') }}"></script>
    {{--DataTables Scripts--}}
    <script src="{{ asset('custom/js/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    <script src="{{ asset('custom/js/dashboard.js') }}"></script>
@endsection


