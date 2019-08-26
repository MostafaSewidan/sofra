@extends('AdminDashBord.layouts.app')
@inject('user' , App\Models\Client)
@inject('restaurant' , App\Models\Resturant)
@section('content')

    @CheckLang
        <section class="content-header">
            <h1>
                <small>{{__('sofra.home_page')}}</small>
                {{__('sofra.home')}}
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"> {{__('sofra.home')}} <i class="fa fa-tachometer-alt"></i></a></li>
            </ol>
        </section>

        <br><br><br>
    @else
        <section class="content-header">
            <h1>
                {{__('sofra.home')}}
                <small>{{__('sofra.home_page')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-tachometer-alt"></i> {{__('sofra.home')}}</a></li>
            </ol>
        </section>

        <br><br><br>
    @endCheckLang

{{--    **************(users)***************************--}}
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$user->all()->count()}}</h3>

                <p>{{__('sofra.users')}}</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <a href="#" class="small-box-footer">{{__('sofra.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
{{--**************************************************--}}

{{--    **************(resturants)***************************--}}
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$restaurant->all()->count()}}</h3>

                    <p>{{__('sofra.restaurant')}}</p>
                </div>
                <div class="icon">
                    <i class="fas fa-utensils"></i>
                </div>
                <a href="#" class="small-box-footer">{{__('sofra.More_info')}} <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
{{--**************************************************--}}

@endsection
