@extends('AdminDashBord.layouts.app')
{{--**********************************************************************--}}


{{--**********************************************************************--}}


@section('content')

    @CheckLang
    <section class="content-header">
        <h1>
            <small>{{__('sofra.change_password')}}</small>
            {{__('sofra.change_password')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/change-password')}}">{{__('sofra.change_password')}}</a></li>
            <li><a href="{{url('/')}}"> {{__('sofra.home')}} <i class="fa fa-tachometer-alt"></i></a></li>

        </ol>
    </section>

    <br><br><br>
    @else
        <section class="content-header">
            <h1>
                {{__('sofra.change_password')}}
                <small>{{__('sofra.change_password_page')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-tachometer-alt"></i> {{__('sofra.home')}}</a></li>
                <li><a href="{{url('/change-password')}}">{{__('sofra.change_password')}}</a></li>
            </ol>
        </section>

        <br><br><br>
        @endCheckLang



        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('sofra.change_password')}}</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">


                    <br>
                    {!! Form::open(
                                                                                      [
                                                                                           'url' =>'/change-password',
                                                                                          'method'=>'post',
                                                                                      ])
                                                                                   !!}



                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.old_password')}}</label>
                        {!! Form::password('old_password' , ['class'=>"form-control"]) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.new_password')}}</label>
                        {!! Form::password('password' , ['class'=>"form-control"]) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.new_password_confirmation')}}</label>
                        {!! Form::password('password_confirmation' ,['class'=>"form-control"]) !!}
                    </div>

                    <br><br>
                    <button type = 'submit' class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        {{__('sofra.change')}}
                    </button>
                    {!! Form::close() !!}



                </div>
                <!-- /.box-body -->

                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>

@endsection