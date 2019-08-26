
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
                    @CheckLang
                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">  {{optional($contact)->name}} : {{__('sofra.name')}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">  {{optional($contact)->sms_body}} : {{__('sofra.sms_body')}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title"> {{optional($contact)->created_at}} : {{__('sofra.created_at')}}</h3>
                        </div>

                        <div class="box-header with-border" style="
        /*                color: #721c24;*/
        /*background-color: #f8d7da;*/
        /*border-color: #f5c6cb;*/
                            color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title"> {{optional($contact)->type}} : {{__('sofra.type')}}</h3>
                        </div>


                    @else
                        <div class="box-header with-border" style="    color: #004085;
        background-color: #cce5ff;
        border-color: #b8daff;
            padding-left: 2pc;
    ">
                            <h3 class="box-title">{{__('sofra.name')}} : {{optional($contact)->name}}</h3>
                        </div>

                        <div class="box-header with-border" style="    color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">{{__('sofra.sms_body')}} : {{optional($contact)->sms_body}}</h3>
                        </div>

                        <div class="box-header with-border" style="color: #856404;
        background-color: #fff3cd;
            padding-left: 2pc;
        border-color: #ffeeba;">
                            <h3 class="box-title">{{__('sofra.created_at')}} : {{optional($contact)->created_at}}</h3>
                        </div>

                        <div class="box-header with-border" style="
        /*                color: #721c24;*/
        /*background-color: #f8d7da;*/
        /*border-color: #f5c6cb;*/
                            color: #155724;
        background-color: #d4edda;
            padding-left: 2pc;
        border-color: #c3e6cb;">
                            <h3 class="box-title">{{__('sofra.type')}} : {{optional($contact)->type}}</h3>
                        </div>


                    @endCheckLang

                    <br>
                    <div style="    padding-left: 2pc; padding-bottom: 1pc;">

                        {!! Form::open(
                                                                  [
                                                                       'url' =>'contacts/'.$contact->id,
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