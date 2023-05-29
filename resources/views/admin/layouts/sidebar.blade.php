<style>
    .menu_item{
        margin-top: 2.5rem;
    }

    .menu-content a{
        font-size: 13px;
        color: white;
        margin-bottom: 15px;
    }

    .menu-content .active a {
        color: rgb(114, 114, 228) !important;
    }
    
    .menu-content:hover a {
        color: rgb(114, 114, 228) !important;
    }
</style>

<div class="aside-menu flex-column-fluid">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
        <!--begin::Menu-->
       
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item here show menu-accordion">
                    <a class="menu-link" href="{{route('dashboard')}}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                    <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title">ड्यासबोर्ड</span>
                    </a>
                </div>
                @if (!empty(session()->get('roleid')==1))
                    <div class="menu-item">

                        @if (auth()->user()->id==4826) 
                            <div class="menu-content pt-8 pb-2">
                                <span class="menu-section text-uppercase fs-8 ls-1 active"><a href="{{'/dashboardpfadminpsup'}}">ड्यासबोर्ड</a></span>
                            </div>
                        @endif

                        {{-- <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('user')) active @endif">
                                <a href="{{route('user')}}">
                                    प्रयोगकर्ता सेटअप
                                </a>
                            </span>
                        </div> --}}

                        {{-- <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1  @if(request()->routeIs('vancacy')) active @endif">
                                <a href="{{route('vancacy')}}">
                                    विज्ञापन
                                </a>
                            </span>
                        </div> --}}
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('registeredCandidatesDetails')) active @endif">
                                <a href="{{route('registeredCandidatesDetails')}}">
                                    दर्ता भएका उम्मेदवार
                                </a>
                            </span>
                        </div>


                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('applicantDetails')) active @endif">
                                <a href="{{route('applicantDetails')}}">
                                    आवेदनहरू
                                </a>
                            </span>
                        </div>

                      
                        {{-- <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('vacancyReport')) active @endif">
                                <a href="{{route('vacancyReport')}}">
                                    विज्ञापन रिपोर्ट
                                </a>
                            </span>
                        </div> --}}

                        {{-- <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('insufficientPaymentReport')) active @endif">
                                <a href="{{route('insufficientPaymentReport')}}">
                                    अपर्याप्त भुक्तानी रिपोर्ट
                                </a>
                            </span>
                        </div> --}}

                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('esewaIpsDetails')) active @endif">
                                <a href="{{route('esewaIpsDetails')}}">
                                    भुक्तानीको रिपोर्ट
                                </a>
                            </span>
                        </div>

                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('admitcard')) active @endif">
                                <a href="{{route('admitcard')}}">
                                    प्रवेश पत्र
                                </a>
                            </span>
                        </div>

                       

                        {{-- <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('khaltiDetails')) active @endif">
                                <a href="{{route('khaltiDetails')}}">
                                    खल्ती
                                </a>
                            </span>
                        </div> --}}
                
                        <div class="menu-content pt-8 pb-2">
                            <span class="menu-section text-muted fs-8 ls-1 @if(request()->routeIs('accesslogs')) active @endif">
                                <a href="{{route('accesslogs')}}">
                                    विवरण परिवर्तनका लागि अनुरोध
                                </a>
                            </span>
                        </div>

                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ (request()->segment(1) == 'setup' || request()->routeIs('vancacy') || request()->routeIs('user*'))  ? 'hover show' : '' }}">
                            <span class="menu-link">

                                <span class="menu-title">सेटअप</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion" {{ (request()->segment(1) == 'setup' || request()->routeIs('vancacy*') || request()->routeIs('user*')) ? 'show' : 'style="display: none; overflow: hidden;"' }}  kt-hidden-height="81">
                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('vancacy') ? 'active' : '' }}"  href="{{ route('vancacy')}}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">विज्ञापन सेटअप</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('examcenter') ? 'active' : '' }}"  href="{{ route('examcenter')}}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">परिक्षा केन्द्र सेटअप</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('symbolnumbers') ? 'active' : '' }}"  href="{{ route('symbolnumbers')}}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title ">सिम्बोल नम्बर सेटअप</span>
                                    </a>
                                </div>

                                <div class="menu-item">
                                    <a class="menu-link {{ Request::routeIs('user') ? 'active' : '' }}"  href="{{ route('user')}}">
                                        <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                                        <span class="menu-title">प्रयोगकर्ता सेटअप</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('applicantprofile') ? 'active' : '' }}"  href="{{ route('applicantprofile')}}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title ">मेरो प्रोफाईल</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('availableVacancy') ? 'active' : '' }}"  href="{{ route('availableVacancy')}}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title ">रिक्त आव‌ेदन</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{ Request::routeIs('myApplication') ? 'active' : '' }}"  href="{{ route('myApplication')}}">
                            <span class="menu-bullet"><span class="bullet bullet-dot"></span></span>
                            <span class="menu-title ">मेरो आवेदन</span>
                        </a>
                    </div>
                @endif
            </div>
        <!--end::Menu-->
    </div>
    <!--end::Aside Menu-->
</div>