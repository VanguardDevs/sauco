@extends('layouts.template')

@section('title', 'Dashboard')

@section('breadcrumbs')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
<div class="col-xl-4">
    <!--Begin::Portlet-->
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Recent Activities
                </h3>
            </div>
            <div class="kt-portlet__head-toolbar">
                <div class="dropdown dropdown-inline">
                    <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flaticon-more-1"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-fit dropdown-menu-md">
                        <!--begin::Nav-->
                        <ul class="kt-nav">
                            <li class="kt-nav__head">
                                Export Options
                                <i class="flaticon2-information" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more..."></i>
                            </li>
                            <li class="kt-nav__separator"></li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-drop"></i>
                                    <span class="kt-nav__link-text">Activity</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-calendar-8"></i>
                                    <span class="kt-nav__link-text">FAQ</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-link"></i>
                                    <span class="kt-nav__link-text">Settings</span>
                                </a>
                            </li>
                            <li class="kt-nav__item">
                                <a href="#" class="kt-nav__link">
                                    <i class="kt-nav__link-icon flaticon2-new-email"></i>
                                    <span class="kt-nav__link-text">Support</span>
                                    <span class="kt-nav__link-badge">
                                        <span class="kt-badge kt-badge--success">5</span>
                                    </span>
                                </a>
                            </li>
                            <li class="kt-nav__separator"></li>
                            <li class="kt-nav__foot">
                                <a class="btn btn-label-danger btn-bold btn-sm" href="#">Upgrade plan</a>
                                <a class="btn btn-clean btn-bold btn-sm" href="#" data-toggle="kt-tooltip" data-placement="right" title="Click to learn more...">Learn more</a>
                            </li>
                        </ul>

                        <!--end::Nav-->
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__body">
                <!--Begin::Timeline 3 -->
                <div class="kt-timeline-v2">
                    <div class="kt-timeline-v2__items  kt-padding-top-25 kt-padding-bottom-30">
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">10:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-danger"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text  kt-padding-top-5">
                                Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                incididunt ut labore et dolore magna
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">12:45</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-success"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-timeline-v2__item-text--bold">
                                AEOL Meeting With
                            </div>
                            <div class="kt-list-pics kt-list-pics--sm kt-padding-l-20">
                                <a href="#"><img src="./assets/media/users/100_4.jpg" title=""></a>
                                <a href="#"><img src="./assets/media/users/100_13.jpg" title=""></a>
                                <a href="#"><img src="./assets/media/users/100_11.jpg" title=""></a>
                                <a href="#"><img src="./assets/media/users/100_14.jpg" title=""></a>
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">14:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-brand"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Make Deposit <a href="#" class="kt-link kt-link--brand kt-font-bolder">USD 700</a> To ESL.
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">16:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-warning"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                incididunt ut labore et dolore magna elit enim at minim<br>
                                veniam quis nostrud
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">17:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-info"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Placed a new order in <a href="#" class="kt-link kt-link--brand kt-font-bolder">SIGNATURE MOBILE</a> marketplace.
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">16:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-brand"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Lorem ipsum dolor sit amit,consectetur eiusmdd tempor<br>
                                incididunt ut labore et dolore magna elit enim at minim<br>
                                veniam quis nostrud
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">17:00</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-danger"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                Received a new feedback on <a href="#" class="kt-link kt-link--brand kt-font-bolder">FinancePro App</a> product.
                            </div>
                        </div>
                        <div class="kt-timeline-v2__item">
                            <span class="kt-timeline-v2__item-time">15:30</span>
                            <div class="kt-timeline-v2__item-cricle">
                                <i class="fa fa-genderless kt-font-danger"></i>
                            </div>
                            <div class="kt-timeline-v2__item-text kt-padding-top-5">
                                New notification message has been received on <a href="#" class="kt-link kt-link--brand kt-font-bolder">LoopFin Pro</a> product.
                            </div>
                        </div>
                    </div>
                </div>
                <!--End::Timeline 3 -->
        </div>
    </div>
    <!--End::Portlet-->
</div>
@endsection
