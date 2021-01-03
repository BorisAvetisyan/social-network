@extends('layouts.index')
@section('title', "Profile")

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
                                <a href="#" class="kt-chat__title">Jason Muller</a>
                                <span class="kt-chat__status">
																<span class="kt-badge kt-badge--dot kt-badge--success"></span> Active
															</span>
                            </div>
                        </div>
                        <div class="kt-chat__right">

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
                    <div class="kt-chat__input">
                        <div class="kt-chat__editor">
                            <textarea style="height: 50px" placeholder="Type here..."></textarea>
                        </div>
                        <div class="kt-chat__toolbar">
                            <div class="kt_chat__tools">
                                <a href="#"><i class="flaticon2-link"></i></a>
                                <a href="#"><i class="flaticon2-photograph"></i></a>
                                <a href="#"><i class="flaticon2-photo-camera"></i></a>
                            </div>
                            <div class="kt_chat__actions">
                                <button type="button" class="btn btn-brand btn-md btn-upper btn-bold kt-chat__reply post" data-target-user="{{ $user->id }}">Post</button>
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
    <script src="{{ asset('custom/js/chat.js') }}"></script>
    <script src="{{ asset('custom/js/profile.js') }}"></script>
@endsection
