@extends('layout')
@section('title', 'Dashboard')

@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row m-t-20">
        <div class="col-md-12">

            {{-- Search Input --}}
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
                    <select type="text" class="form-control" name="filter" id="">
                        <option value="friends" selected="selected">Friends</option>
                        <option value="pending">Pending</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
            </div>
            {{-- End Search Input --}}

            {{-- Friends List --}}
            <div class="people-container">
                <div class="items">
                    <div class="item">
                        <span class="media">
                            <img src="{{ asset('media/profile.png') }}" class="profile-image" alt="">
                        </span>
                        <div class="info">
                            <span>
                                <a href="#">Boris Avetisyan</a>
                            </span>
                        </div>
                        <div class="right-status">
                            <span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill">Approved</span>
                        </div>
                    </div>
                    <div class="item">
                        <span class="media">
                            <img src="{{ asset('media/profile.png') }}" class="profile-image" alt="">
                        </span>
                        <div class="info">
                            <span>
                                <a href="#">Karen Darpinyan</a>
                            </span>
                        </div>
                        <div class="right-status">
                            <span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <h2>Suggestions</h2>
            {{-- Friends List --}}
            <div class="people-container">
                <div class="items">
                    @foreach($suggestions as $suggestion)
                        <div class="item">
                            <span class="media">
                                <img src="{{ asset('media/profile.png') }}" class="profile-image" alt="">
                            </span>
                            <div class="info">
                            <span>
                                <a href="#">{{ $suggestion->name . ' ' . $suggestion->surname . '('.$suggestion->email.')'}}</a>
                                <span class="kt-badge kt-badge--info kt-badge--inline kt-badge--pill">{{ $suggestion->status }}</span>
                            </span>
                            </div>
                            <div class="right-status">
                                <button class="suggestion-action" data-action="{{ \App\Models\Relationship::APPROVED }}" data-suggestion="{{ $suggestion->id }}" >Accept</button>
                                <button class="suggestion-action" data-action="{{ \App\Models\Relationship::REJECTED }}" data-suggestion="{{ $suggestion->id }}" >Reject</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


        </div>
    </div>
@endsection

@section('custom_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="{{ asset('custom/js/dashboard.js') }}"></script>
@endsection


