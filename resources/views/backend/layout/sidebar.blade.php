<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
        class="la la-close"></i></button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

    <!-- BEGIN: Aside Menu -->
    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
        m-menu-vertical="1" m-menu-scrollable="1" m-menu-dropdown-timeout="500" style="position: relative;">
        <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
            @if (Auth::user()->role == 1)
                <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('admin.index') }}"
                        class="m-menu__link "><i class="m-menu__link-icon flaticon-line-graph"></i><span
                            class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span
                                    class="m-menu__link-text">Dashboard</span>
                                <span class="m-menu__link-badge"></span>
                            </span></span></a>
                </li>
                {{-- User --}}
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <a href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon la la-user"></i><span class="m-menu__link-text">Tài khoản</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('user.index') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Danh sách tài khoản</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('user.add') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Thêm mới</span></a></li>
                        </ul>
                    </div>
                </li>
            @endif

            <li class="m-menu__section ">
                <h4 class="m-menu__section-text">Lịch khám</h4>
                <i class="m-menu__section-icon flaticon-more-v2"></i>
            </li>

            {{-- đặt lịch --}}
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                    href="javascript:;" class="m-menu__link m-menu__toggle"><i
                        class="m-menu__link-icon la la-calendar"></i><span class="m-menu__link-text">Lịch khám</span><i
                        class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('booking.index') }}"
                                class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">Danh sách lịch khám</span></a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('booking.waitingLine') }}"
                                class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">Danh sách chờ khám</span></a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('booking.waitingLine.today') }}"
                            class="m-menu__link "><i
                                class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                class="m-menu__link-text">Danh sách chờ khám hôm nay</span></a>
                        </li>
                        <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('list.cancel.order') }}"
                                class="m-menu__link "><i
                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                    class="m-menu__link-text">Danh sách đơn hủy</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- calendar --}}
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                    href="javascript:;" class="m-menu__link m-menu__toggle"><i
                        class="m-menu__link-icon la la-calendar-plus-o"></i><span class="m-menu__link-text">Xếp lịch
                        khám</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item " aria-haspopup="true">
                            <a href="{{ route('timeline.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">Xếp lịch khám</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if (Auth::user()->role == 1)
                <li class="m-menu__section ">
                    <h4 class="m-menu__section-text">Bài viết</h4>
                    <i class="m-menu__section-icon flaticon-more-v2"></i>
                </li>
                {{-- bác sĩ --}}
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                        href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon la la-stethoscope"></i><span class="m-menu__link-text">Bác
                            sĩ</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('doctor.index') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Danh sách bác sĩ</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('doctor.add') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Thêm mới</span></a></li>
                        </ul>
                    </div>
                </li>
                {{-- dịch vụ --}}
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                        href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon flaticon-layers"></i><span class="m-menu__link-text">Dịch
                            vụ</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('services.index') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Danh sách dịch vụ</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('services.add') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Thêm mới</span></a></li>
                        </ul>
                    </div>
                </li>


                {{-- slider --}}
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                        href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon la la-image"></i><span class="m-menu__link-text">Slider</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('slider.index') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Danh sách Slider</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('slider.add') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Thêm mới</span></a></li>
                        </ul>
                    </div>
                </li>
                {{-- bài viết --}}
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                        href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon la la-indent"></i><span class="m-menu__link-text">Chuyên
                            mục</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('category.index') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Danh sách chuyên mục</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('category.add') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Thêm mới</span></a></li>
                        </ul>
                    </div>
                </li>
                {{-- Bài viết --}}
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                        href="javascript:;" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon la la-file-text"></i><span class="m-menu__link-text">Bài
                            viết</span><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                    <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('article.index') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Danh sách bài viết</span></a></li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="{{ route('article.add') }}"
                                    class="m-menu__link "><i
                                        class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                        class="m-menu__link-text">Thêm mới</span></a></li>
                        </ul>
                    </div>
                </li>
                <li class="m-menu__section ">
                    <h4 class="m-menu__section-text">Cài đặt</h4>
                    <i class="m-menu__section-icon flaticon-more-v2"></i>
                </li>
                {{-- setting --}}
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover"><a
                        href="{{ route('setting.index') }}" class="m-menu__link m-menu__toggle"><i
                            class="m-menu__link-icon la la-cog"></i><span class="m-menu__link-text">Cài đặt</span><i
                            class="m-menu__ver-arrow la la-angle-right"></i></a>
                </li>
            @endif

        </ul>
    </div>

    <!-- END: Aside Menu -->
</div>
{{-- quang --}}
<!-- END: Left Aside -->
