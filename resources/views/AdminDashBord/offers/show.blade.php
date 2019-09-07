
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
                <h3 class="box-title">{{__('sofra.offer_details')}}</h3>

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
                    <center>
                        <img src="{{asset(optional($offer->image()->first())->name)}}" style ="    width: 398px;
    /* height: 19pc; */
    border-radius: 169px;
    box-shadow: 9px 8px 33px -14px #00000096;
    border: 9px solid white;">
                    </center>
                    <br>
                    @CheckLang
                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">  {{optional($offer)->name}} : {{__('sofra.name')}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">  {{optional($offer)->details}} : {{__('sofra.details')}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title"> {{optional($offer)->start_date}} : {{__('sofra.start_date')}}</h3>
                        </div>

                        <div class="box-header with-border" style="
        /*                color: #721c24;*/
        /*background-color: #f8d7da;*/
        /*border-color: #f5c6cb;*/
                            color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title"> {{optional($offer)->end_date}} : {{__('sofra.end_date')}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title"> {{optional($offer)->created_at}} : {{__('sofra.created_at')}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title"> {{optional($offer->resturant()->first())->name}} : {{__('sofra.restaurant')}}</h3>
                        </div>

                    @else
                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">{{__('sofra.name')}} : {{optional($offer)->name}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">{{__('sofra.details')}} : {{optional($offer)->details}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title">{{__('sofra.start_date')}} : {{optional($offer)->start_date}}</h3>
                        </div>

                        <div class="box-header with-border" style="
        /*                color: #721c24;*/
        /*background-color: #f8d7da;*/
        /*border-color: #f5c6cb;*/
                            color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">{{__('sofra.end_date')}} : {{optional($offer)->end_date}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">{{__('sofra.created_at')}} : {{optional($offer)->created_at}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title">{{__('sofra.restaurant')}} : {{optional($offer)->resturant()->first()->name}}</h3>
                        </div>

                    @endCheckLang

                    <br>
                    <div style="    padding-left: 2pc; padding-bottom: 1pc;">

                        {!! Form::open(
                                                                  [
                                                                       'url' =>'offers/'.$offer->id,
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