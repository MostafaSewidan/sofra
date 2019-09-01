
@extends('AdminDashBord.layouts.app')
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

        </h1>

    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('sofra.order_details')}}</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">



                <div class="box box-primary">
                    <br>
{{--                    <center>--}}
{{--                        <img src="{{asset(optional($order)->image->first()->name)}}" style ="--}}
{{--    /* height: 19pc; */--}}
{{--    border-radius: 169px;--}}
{{--    box-shadow: 9px 8px 33px -14px #00000096;--}}
{{--    border: 9px solid white;">--}}
{{--                    </center>--}}
                    <br>
                    @CheckLang
                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">  {{optional($order)->client()->first()->name}} : {{__('sofra.client_name')}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">  {{optional($order)->resturant()->first()->name}} : {{__('sofra.restaurant_name')}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title"> {{optional($order)->price}} : {{__('sofra.price')}}</h3>
                        </div>

                        <div class="box-header with-border" style="
        /*                color: #721c24;*/
        /*background-color: #f8d7da;*/
        /*border-color: #f5c6cb;*/
                            color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title"> {{optional($order)->detalis}} : {{__('sofra.details')}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title"> {{optional($order)->created_at}} : {{__('sofra.created_at')}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
            background-color: #fff3cd;
                padding-left: 2pc;
            border-color: #ffeeba;">
                            <h3 class="box-title"> {{optional($order)->address}} : {{__('sofra.address')}}</h3>
                        </div>



                    @else
                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">{{__('sofra.client_name')}} : {{optional($order)->client()->first()->name}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">{{__('sofra.restaurant_name')}} : {{optional($order)->resturant()->first()->name}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title">{{__('sofra.price')}} : {{optional($order)->price}}</h3>
                        </div>

                        <div class="box-header with-border" style="
        /*                color: #721c24;*/
        /*background-color: #f8d7da;*/
        /*border-color: #f5c6cb;*/
                            color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">{{__('sofra.details')}} : {{optional($order)->detalis}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">{{__('sofra.created_at')}} : {{optional($order)->created_at}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
            background-color: #fff3cd;
                padding-left: 2pc;
            border-color: #ffeeba;">
                            <h3 class="box-title"> {{optional($order)->address}} : {{__('sofra.address')}}</h3>
                        </div>


                    @endCheckLang

                    <br>
                    <div class="col-lg-12" style="    margin-top: 1pc;">
                        <div class="col-lg-2" style="    padding-left: 2pc; padding-bottom: 1pc;">

                            {!! Form::open(
                                                                      [
                                                                           'url' =>'orders/'.$order->id,
                                                                          'method'=>'DELETE'
                                                                      ])
                                                                   !!}

                            <button  type="submit" class="btn btn-danger" style="margin-right: 1pc"
                               onclick="return confirm('Please confirm delete');"
                            >
                                <i class="fas fa-trash-alt"  style="font-size: 21px;color: white;">
                                    {{__('sofra.delete')}}
                                </i>
                            </button>
                            {!! Form::close() !!}

                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
@endsection