@extends('layout')

@section('custom_css')
@endsection

@section('content')
    <div class="kt-grid__item kt-app__toggle kt-app__aside kt-app__aside--lg kt-app__aside--fit" id="kt_chat_aside">

        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--last">
            <div class="kt-portlet__body">
                <div class="kt-searchbar">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24"></rect>
																	<path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
																	<path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero"></path>
																</g>
															</svg></span></div>
                        <input type="text" class="form-control" placeholder="Search" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="kt-widget kt-widget--users kt-mt-20">
                    <div class="kt-scroll kt-scroll--pull ps ps--active-y" style="height: 227px; overflow: hidden;">
                        <div class="kt-widget__items">
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_9.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Matt Pears</a>
                                        <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                    </div>
                                    <span class="kt-widget__desc">
																	Head of Development
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">36 Mines</span>
                                    <span class="kt-badge kt-badge--success kt-font-bold">7</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_7.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Charlie Stone</a>
                                        <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                    </div>
                                    <span class="kt-widget__desc">
																	Art Director
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">5 Hours</span>
                                    <span class="kt-badge kt-badge--success kt-font-bold">2</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_12.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Jason Muller</a>
                                        <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                    </div>
                                    <span class="kt-widget__desc">
																	Python Developer
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">2 Days</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_4.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Teresa Fox</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	PR Executive
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">4 Days</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_8.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Giannis Nelson</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	Lead Cowboy
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">1 Week</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_10.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Lisa Moss</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	QA Manager
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">3 Week</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_13.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Carles Puyol</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	Defence Officer
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">2 Month</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_21.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Luka Doncic</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	Dose whatever he wants
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">1 Year</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_9.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Matt Pears</a>
                                        <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                    </div>
                                    <span class="kt-widget__desc">
																	Head of Development
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">36 Mines</span>
                                    <span class="kt-badge kt-badge--success kt-font-bold">7</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_7.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Charlie Stone</a>
                                        <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                    </div>
                                    <span class="kt-widget__desc">
																	Art Director
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">5 Hours</span>
                                    <span class="kt-badge kt-badge--success kt-font-bold">2</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_12.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Jason Muller</a>
                                        <span class="kt-badge kt-badge--success kt-badge--dot"></span>
                                    </div>
                                    <span class="kt-widget__desc">
																	Python Developer
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">2 Days</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_4.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Teresa Fox</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	PR Executive
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">4 Days</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/100_8.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Giannis Nelson</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	Lead Cowboy
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">1 Week</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_10.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Lisa Moss</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	QA Manager
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">3 Week</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_13.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Carles Puyol</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	Defence Officer
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">2 Month</span>
                                </div>
                            </div>
                            <div class="kt-widget__item">
															<span class="kt-media kt-media--circle">
																<img src="assets/media/users/300_21.jpg" alt="image">
															</span>
                                <div class="kt-widget__info">
                                    <div class="kt-widget__section">
                                        <a href="#" class="kt-widget__username">Luka Doncic</a>
                                    </div>
                                    <span class="kt-widget__desc">
																	Dose whatever he wants
																</span>
                                </div>
                                <div class="kt-widget__action">
                                    <span class="kt-widget__date">1 Year</span>
                                </div>
                            </div>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 227px; right: -2px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 44px;"></div></div></div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
@endsection


