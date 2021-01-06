@extends('layouts.index')
@section('title', 'Dashboard')

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link href="{{ asset('custom/js/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('lib/select2/dist/css/select2.css') }}">
@endsection

@section('content')

    <div class="kt-portlet__body">
        <div class="kt-form kt-form--label-right kt-margin-t-20 kt-margin-b-10">
            <div class="row align-items-center">
                <div class="col-xl-8 order-2 order-xl-1">
                    <div class="kt-searchbar">
                        <div class="input-group">
                            <select class="search-people form-control search-input" name="" id="search-people"></select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__head  border-bottom-0">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Network
                </h3>
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
                                            <option selected="selected" value="{{ \App\Models\Relationship::APPROVED }}">
                                                Friends
                                            </option>
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
            <div class="users-datatable" id="users-datatable" data-url="{{ route('users.data') }}"></div>
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__head  border-bottom-0">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Notifications
                </h3>
            </div>
        </div>

        <div class="kt-portlet__body  kt-portlet__body--fit">
            <div class="notifications-datatable" id="notifications-datatable" data-url="{{ route('notifications.data') }}"></div>
        </div>
    </div>

@endsection

@section('custom_scripts')
    <script src="{{ asset('lib/select2/dist/js/select2.js') }}"></script>
    <script src="{{ asset('custom/js/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

    <script src="{{ asset('custom/js/utils.js') }}"></script>
    <script src="{{ asset('custom/js/dashboard.js') }}"></script>
@endsection


