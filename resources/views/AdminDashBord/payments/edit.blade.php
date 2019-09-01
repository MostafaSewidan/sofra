@extends('AdminDashBord.layouts.app')

{{--**********************************************************************--}}

@section('style')

    <style>
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 73%;
        @CheckLang
        margin-left: 3%;
            @else
                margin-left: 21%;
        @endCheckLang

        }

        /* The Close Button */
        .close {
            color: white;
            background-color: #b50000;
            font-size: 28px;
            font-weight: bold;
            opacity: unset;
            padding: 0px 7px 3px 7px;
            border-radius: 5px;
            transition: width 2s, height 4s;
        @CheckLang
        float: left;
            @else
                float: right;
        @endCheckLang
        }

        .close:hover,
        .close:focus {
            color: white;
            background-color: #b50000;
            padding: 1px 8px 4px 8px;
            text-decoration: none;
            cursor: pointer;
            opacity: unset;
            box-shadow: black 1px 4px 7px;
        }
    </style>

@endsection

{{--**********************************************************************--}}


@section('content')

    @CheckLang
    <section class="content-header">
        <h1>
            <small>{{__('sofra.payment_edit')}}</small>
            {{__('sofra.edit')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/payments/edit')}}">{{__('sofra.edit')}}</a></li>
            <li><a href="{{url('/payments')}}">{{__('sofra.payment')}}</a></li>
            <li><a href="{{url('/')}}"> {{__('sofra.home')}} <i class="fa fa-tachometer-alt"></i></a></li>

        </ol>
    </section>

    <br><br><br>
    @else
        <section class="content-header">
            <h1>
                {{__('sofra.Payment')}}
                <small>{{__('sofra.payment_page')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-tachometer-alt"></i> {{__('sofra.home')}}</a></li>
                <li><a href="{{url('/payments')}}">{{__('sofra.payment')}}</a></li>
                <li><a href="{{url('/payments/edit')}}">{{__('sofra.edit')}}</a></li>
            </ol>
        </section>

        <br><br><br>
        @endCheckLang



    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">EDIT FORM</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">


                {!! Form::open(
                                                                    [
                                                                         'url' =>'payments/'.$payment->id,
                                                                        'method'=>'PUT'
                                                                    ])
                                                                 !!}
                {!! Form::text('payment' ,$payment->payment ,['class'=>"form-control"]) !!}
                <br>

                @CheckLang

                <button type = 'submit' class="btn btn-primary">{{__('sofra.edit')}} <i class="fas fa-plus"></i> </button>

                @else

                    <button type = 'submit' class="btn btn-primary"><i class="fas fa-plus"></i> {{__('sofra.edit')}}</button>

                    @endCheckLang
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>

@endsection