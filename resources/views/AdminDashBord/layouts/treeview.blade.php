<ul class="sidebar-menu" data-widget="tree">
    <li class="header">{{__('sofra.MAIN_NAVIGATION')}}</li>



    @if(auth()->user()->can('users'))

        <li class="active">


            @CheckLang

            <a href='{{url('/users')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.admins')}}</span>
                <i class="fas fa-user-shield"></i>

            </a>

            @else

                <a href='{{url('/users')}}'>

                    <i class="fas fa-user-shield" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.admins')}}</span>

                </a>

                @endCheckLang
        </li>

    @endif


    @if(auth()->user()->can('roles'))

        <li class="active">


            @CheckLang

            <a href='{{url('/roles')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.roles')}}</span>
                <i class="fas fa-shield-alt"></i>

            </a>

            @else

                <a href='{{url('/roles')}}'>

                    <i class="fas fa-shield-alt" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.roles')}}</span>

                </a>

                @endCheckLang
        </li>

    @endif



    @if(auth()->user()->can('cities'))

        <li class="active">


            @CheckLang
            <a href='{{url('/cities')}}' style="text-align: right">
                <span  style="padding-right: 1pc">{{trans('sofra.Cities')}}</span> <i class="fas fa-flag"> </i>
            </a>
            @else
                <a href='{{url('/cities')}}'>
                    <i class="fas fa-flag" style="padding-right: 1pc"> </i>  <span>{{trans('sofra.Cities')}}</span>
                </a>
                @endCheckLang
        </li>

    @endif



    @if(auth()->user()->can('districts'))

        <li class="active">


            @CheckLang

            <a href='{{url('/districts')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.districts')}}</span>
                <i class="fas fa-road"></i>

            </a>

            @else

                <a href='{{url('/districts')}}'>

                    <i class="fas fa-road" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.districts')}}</span>

                </a>

                @endCheckLang
        </li>

    @endif



    @if(auth()->user()->can('clients'))

        <li class="active">


            @CheckLang

            <a href='{{url('/clients')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.users')}}</span>
                <i class="fas fa-users"></i>

            </a>

            @else

                <a href='{{url('/clients')}}'>

                    <i class="fas fa-users" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.users')}}</span>

                </a>

                @endCheckLang
        </li>

    @endif



    @if(auth()->user()->can('restaurants'))

        <li class="treeview">

            @CheckLang
            <a href="#" style="text-align: right">
                <span style="padding-right: 1pc;">{{trans('sofra.restaurant')}}</span> <i class="fas fa-utensils"> </i>
                <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                </span>
            </a>
            <ul class="treeview-menu">
                @if(auth()->user()->can('restaurants'))

                    <li>
                        <a href="{{url('/restaurants')}}">

                            {{__('sofra.show_restaurants')}}
                            <i  class="fas fa-eye" style="padding-left: 1pc"></i>

                        </a>
                    </li>

                @endif


                    @if(auth()->user()->can('orders'))

                        <li>
                            <a href="{{url('/orders')}}">

                                {{__('sofra.manage_orders')}}
                                <i  class="fas fa-shopping-bag" style="padding-left: 1pc"></i>

                            </a>
                        </li>

                    @endif


                    @if(auth()->user()->can('offers'))

                        <li>
                            <a href="{{url('/offers')}}">

                                {{__('sofra.manage_offers')}}
                                <i  class="fas fa-shopping-cart" style="padding-left: 1pc"></i>

                            </a>
                        </li>

                    @endif


                    @if(auth()->user()->can('payments'))

                        <li>
                            <a href="{{url('/payments')}}">

                                {{__('sofra.manage_payments')}}
                                <i  class="fas fa-piggy-bank" style="padding-left: 1pc"></i>

                            </a>
                        </li>

                    @endif


            </ul>

            {{--**************************************************************************************************************************************--}}

            @else


                {{--**************************************************************************************************************************************--}}
                <a href="#">
                    <i class="fas fa-utensils" style="padding-right: 1pc"> </i> <span>{{trans('sofra.restaurant')}}</span>
                    <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                        </span>
                </a>
                <ul class="treeview-menu">

                    @if(auth()->user()->can('restaurants'))

                        <li>
                            <a href="{{url('/restaurants')}}">

                                <i  class="fas fa-eye" style="padding-right: 1pc"></i>
                                {{__('sofra.show_restaurants')}}

                            </a>
                        </li>

                    @endif


                        @if(auth()->user()->can('orders'))

                            <li>
                                <a href="{{url('/orders')}}">

                                    <i  class="fas fa-shopping-bag" style="padding-right: 1pc"></i>
                                    {{__('sofra.manage_orders')}}

                                </a>
                            </li>

                        @endif


                        @if(auth()->user()->can('offers'))

                            <li>
                                <a href="{{url('/offers')}}">

                                    <i  class="fas fa-shopping-cart" style="padding-right: 1pc"></i>
                                    {{__('sofra.manage_offers')}}

                                </a>
                            </li>

                        @endif


                        @if(auth()->user()->can('payments'))

                            <li>
                                <a href="{{url('/payments')}}">

                                    <i  class="fas fa-piggy-bank" style="padding-right: 1pc"></i>
                                    {{__('sofra.manage_payments')}}

                                </a>
                            </li>

                        @endif

                </ul>
                @endCheckLang


        </li>

    @endif



    @if(auth()->user()->can('categories'))

        <li class="active">


            @CheckLang

            <a href='{{url('/categories')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.categories')}}</span>
                <i class="fas fa-typo3"></i>

            </a>

            @else

                <a href='{{url('/categories')}}'>

                    <i class="fas fa-typo3" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.categories')}}</span>

                </a>

                @endCheckLang
        </li>

    @endif



    @if(auth()->user()->can('contacts'))

        <li class="active">


            @CheckLang

            <a href='{{url('/contacts')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.contacts')}}</span>
                <i class="fas fa-envelope"></i>

            </a>

            @else

                <a href='{{url('/contacts')}}'>

                    <i class="fas fa-envelope" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.contacts')}}</span>

                </a>

                @endCheckLang
        </li>

    @endif



    @if(auth()->user()->can('app-settings'))

        <li class="active">


            @CheckLang

            <a href='{{url('/app-settings')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.app_settings')}}</span>
                <i class="fas fa-cogs"></i>

            </a>

            @else

                <a href='{{url('/app-settings')}}'>

                    <i class="fas fa-cogs" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.app_settings')}}</span>

                </a>

                @endCheckLang
        </li>

    @endif





        <li class="active">


            @CheckLang

            <a href='{{url('/change-password')}}' style="text-align: right">

                <span  style="padding-right: 1pc">{{trans('sofra.change_password')}}</span>
                <i class="fas fa-key"></i>

            </a>

            @else

                <a href='{{url('/change-password')}}'>

                    <i class="fas fa-key" style="padding-right: 1pc"></i>
                    <span>{{trans('sofra.change_password')}}</span>

                </a>

                @endCheckLang
        </li>








</ul>




