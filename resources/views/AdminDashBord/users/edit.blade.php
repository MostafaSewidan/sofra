@extends('AdminDashBord.layouts.app')
@inject('roles',App\Models\Role)
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
            background-color: rgba(0,0,0,0.4); /* Black w/ oparole */
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
            <small>{{__('sofra.user_edit')}}</small>
            {{__('sofra.edit')}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/users/edit')}}">{{__('sofra.edit')}}</a></li>
            <li><a href="{{url('/users')}}">{{__('sofra.user')}}</a></li>
            <li><a href="{{url('/')}}"> {{__('sofra.home')}} <i class="fa fa-tachometer-alt"></i></a></li>

        </ol>
    </section>

    <br><br><br>
    @else
        <section class="content-header">
            <h1>
                {{__('sofra.User')}}
                <small>{{__('sofra.user_page')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-tachometer-alt"></i> {{__('sofra.home')}}</a></li>
                <li><a href="{{url('/users')}}">{{__('sofra.user')}}</a></li>
                <li><a href="{{url('/users/edit')}}">{{__('sofra.edit')}}</a></li>
            </ol>
        </section>

        <br><br><br>
        @endCheckLang



    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{__('sofra.edit_user')}}</h3>

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
                                                                             'url' =>'users/'.$user->id,
                                                                            'method'=>'PUT',
                                                                            'files'=> 'true'
                                                                        ])
                                                                     !!}


                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.name')}}</label>
                        {!! Form::text('name' , $user->name ,['class'=>"form-control"]) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.email')}}</label>
                        {!! Form::text('email' , $user->email ,['class'=>"form-control"]) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.password')}}</label>
                        {!! Form::password('password' , ['class'=>"form-control"]) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.password_confirmation')}}</label>
                        {!! Form::password('password_confirmation' ,['class'=>"form-control"]) !!}
                    </div>

                    <div class="form-group">
                        <label for="exampleInputFile">{{__('sofra.Image ')}}</label>


                        {!! Form::file('img') !!}

                    </div>

                    <br><br>
                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('sofra.roles')}}</label>
                        <br><br>
                        @foreach( $roles->all() as $role)

                            <label class="col-lg-3">
                                <input
                                        type="checkbox"
                                        name="roles_list[]"
                                        value="{{$role->id}}"
                                        @if($user->hasRole($role->name))
                                        checked
                                        @endif
                                > {{$role->display_name}}
                            </label>

                        @endforeach

                    </div>

                    <br><br>
                    <button type = 'submit' class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        {{__('sofra.edit')}}
                    </button>
                    {!! Form::close() !!}

            </div>
            <!-- /.box-body -->

            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>

@endsection