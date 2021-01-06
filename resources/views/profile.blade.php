@extends('layouts.index')
@section('title', "Profile")

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('custom/css/profile.css') }}">
@endsection

@section('content')
    <!--Begin:: App Content-->
    <div class="kt-grid__item kt-grid__item--fluid kt-app__content" id="kt_chat_content">
        <div class="kt-chat">
            <div class="kt-portlet kt-portlet--head-lg kt-portlet--last">
                <div class="kt-portlet__head">
                    <div class="kt-chat__head ">
                        <div class="kt-chat__left">
                            <!--begin:: Aside Mobile Toggle -->
                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md kt-hidden-desktop" id="kt_chat_aside_mobile_toggle">
                                <i class="flaticon2-open-text-book"></i>
                            </button>
                        </div>
                        <div class="kt-chat__center">
                            <div class="kt-chat__label">
                                <a href="#" class="kt-chat__title">{{ $user->name . ' ' . $user->surname }}</a>
                                <span class="kt-chat__status">
                                    {{ $user->email }}
                                </span>
                            </div>
                        </div>
                        <div class="kt-chat__right">
                            @if(\Illuminate\Support\Facades\Auth::id() != $user->id)
                                @if(!empty($singleUserRelationship))
                                    @if($singleUserRelationship->status === \App\Models\Relationship::APPROVED)
                                        <button class="btn btn-info btn-sm unfriend" data-relationship="{{ $singleUserRelationship->id }}">Unfriend</button>
                                    @elseif($singleUserRelationship->status === \App\Models\Relationship::PENDING)
                                        @if($singleUserRelationship->sender_id == \Illuminate\Support\Facades\Auth::id())
                                            <button class="btn btn-warning btn-sm handle-sent-request"
                                                    data-relationship="{{ $singleUserRelationship->id }}"
                                            >Pending/Cancel</button>
                                        @else
                                                <button class="btn btn-info btn-sm suggestion-action"
                                                        data-relationship="{{ $singleUserRelationship->id }}"
                                                        data-action="{{ \App\Models\Relationship::APPROVED }}"
                                                >Approve</button>

                                                <button class="btn btn-danger btn-sm suggestion-action"
                                                        data-relationship="{{ $singleUserRelationship->id }}"
                                                        data-action="{{ \App\Models\Relationship::REJECTED }}"
                                                >
                                                 Reject
                                                </button>
                                        @endif
                                    @else
                                        @if($singleUserRelationship->receiver_id == \Illuminate\Support\Facades\Auth::id())
                                            <button class="btn btn-success btn-sm friend" data-user="{{ $user->id }}">Send Friend Request</button>
                                        @else
                                            <button class="btn btn-danger btn-sm friend" data-user="{{ $user->id }}">Rejected/Resend</button>
                                        @endif
                                    @endif
                                @else
                                    <button class="btn btn-success btn-sm friend" data-user="{{ $user->id }}" data-status="{{ \App\Models\Relationship::PENDING }}">Send Friend Request</button>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <div class="kt-scroll kt-scroll--pull" data-mobile-height="300">
                        <div class="kt-chat__messages">
                            @foreach($posts as $post)
                                @if($post->sender_id === \Illuminate\Support\Facades\Auth::id())
                                    <div class="kt-chat__message kt-chat__message--right">
                                        <div class="kt-chat__user">
                                            <span class="kt-chat__datetime">{{ $post->created_at  }}</span>
                                            <a href="#" class="kt-chat__username">You</span></a>
                                            <span class="kt-media kt-media--circle kt-media--sm"></span>
                                        </div>
                                        <div class="kt-chat__text kt-bg-light-brand">
                                            {{ $post->value }}
                                        </div>
                                    </div>
                                @else
                                    <div class="kt-chat__message">
                                        <div class="kt-chat__user">
                                            <span class="kt-media kt-media--circle kt-media--sm"></span>
                                            <a href="#" class="kt-chat__username">{{ $post->sender->name . ' ' . $post->sender->surname }}</span></a>
                                            <span class="kt-chat__datetime">{{ $post->created_at }}</span>
                                        </div>
                                        <div class="kt-chat__text kt-bg-light-success">
                                            {{ $post->value }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot">
                    <div class="kt-chat-input">
                        <div class="kt-chat__editor">
                            @if($isFriend || user()->id == $user->id)
                                <textarea style="height: 50px" placeholder="Type here..."></textarea>
                            @else
                                <textarea style="height: 50px" disabled="disabled" placeholder="Becoming friends you will have capability to write a posts on this page" class="send-request"></textarea>
                            @endif
                        </div>
                        <div class="kt-chat__toolbar">
                            <div class="kt_chat__tools">
                                <a href="#"><i class="flaticon2-link"></i></a>
                                <a href="#"><i class="flaticon2-photograph"></i></a>
                                <a href="#"><i class="flaticon2-photo-camera"></i></a>
                            </div>
                            <div class="kt_chat__actions">
                                <button type="button" class="btn btn-brand btn-md btn-upper btn-bold post"
                                        {{ ($isFriend || user()->id == $user->id) ? "" : "disabled" }}
                                        data-target-user="{{ $user->id }}">Post</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--End:: App Content-->
@endsection

@section('custom_scripts')
    <script src="{{ asset('custom/js/utils.js') }}"></script>
    <script src="{{ asset('custom/js/chat.js') }}"></script>
    <script src="{{ asset('custom/js/profile.js') }}"></script>
@endsection
