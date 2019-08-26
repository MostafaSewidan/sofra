<ul class="sidebar-menu" data-widget="tree">
    <li class="header">{{__('sofra.MAIN_NAVIGATION')}}</li>

    <li class="treeview">

            @if(session('language') == 'en')
                <a href="#">
                    <i class="fas fa-flag" style="padding-right: 1pc"> </i> <span>{{trans('sofra.gov')}}</span>
                    <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
            @endif
            @if(session('language') == 'ar')
                    <a href="#" style="text-align: right">
                        <span style="padding-right: 1pc;">{{trans('sofra.gov')}}</span> <i class="fas fa-flag"> </i>
                        <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
            @endif

        <ul class="treeview-menu">
            <li><a href="{{url('/governorate')}}"><i  class="fas fa-eye" style="padding-right: 1pc"></i>  show Governorate</a></li>
            <li><a href="{{url('/create')}}"><i class="fas fa-plus" style="padding-right: 1pc"></i>  Add Governorate</a></li>
        </ul>
    </li>


    <li class="active">


        @if(session('language') == 'en')
            <a href='{{url('/donations')}}'>
                <i class="fas fa-cogs" style="padding-right: 1pc"></i> <span>{{trans('sofra.Donation_Requests')}}</span>
            </a>
        @endif
        @if(session('language') == 'ar')
                <a href='{{url('/donations')}}' style="text-align: right">
                     <span  style="padding-right: 1pc">{{trans('sofra.Donation_Requests')}}</span> <i class="fas fa-cogs"></i>
                </a>
        @endif
    </li>


</ul>