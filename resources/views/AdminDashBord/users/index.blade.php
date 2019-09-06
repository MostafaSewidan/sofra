{{--***********************************************************************--}}

@extends('AdminDashBord.layouts.app')
<?php $users = \App\User::all(); ?>

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
            background-color: rgba(0,0,0,0.4); /* Black w/ opauser */
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
            {{__('sofra.User')}}
            <small>{{__('sofra.user_page')}}</small>
        </h1>
        <ol class="breadcrumb">
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
            </ol>
        </section>

        <br><br><br>
        @endCheckLang

        <section class="content">

            @CheckLang

            <button id="myBtn" class="btn btn-primary"> {{__('sofra.ADD_User')}} <i class="fas fa-plus"></i></button>
            <br>
            <br>

            @else
                <button id="myBtn" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('sofra.ADD_User')}} </button>
                <br>
                <br>
            @endCheckLang

            <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{__('sofra.users_table')}}</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>

                        @CheckLang
                            <tr>
                                <th>{{__('sofra.delete')}}</th>
                                <th>{{__('sofra.edit')}}</th>
                                <th>{{__('sofra.role')}}</th>
                                <th>{{__('sofra.email')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.id')}}</th>
                            </tr>
                        @else
                            <tr>
                                <th>{{__('sofra.id')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.email')}}</th>
                                <th>{{__('sofra.role')}}</th>
                                <th>{{__('sofra.edit')}}</th>
                                <th>{{__('sofra.delete')}}</th>
                            </tr>
                        @endCheckLang

                    </thead>
                    <tbody>
                    @foreach( $users as $user)
                        @CheckLang
                            <tr>

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                                    [
                                                                         'url' =>'users/'.$user->id,
                                                                        'method'=>'DELETE'
                                                                    ])
                                                                 !!}
                                    <button
                                            type = 'submit'
                                            class="fas fa-trash-alt"
                                            style="
                                                font-size: 21px;
                                                color: #b50000;
                                                background: #ffffff00;
                                                border: none;
                                            "
                                            onclick="return confirm('{{__('sofra.confirm_delete_user')}}');">

                                    </button>

                                    {!! Form::close() !!}

                                </td>

                                <td style=" text-align: center">
                                    <a href="{{url('/users/'.$user->id.'/edit')}}">
                                        <i class="fas fa-pen-square" style="color: #51a112;    font-size: 25px;"></i>
                                    </a>
                                </td>


                                <td>{{optional($user)->display_name}}</td>
                                <td>{{optional($user)->name}}</td>
                                <td>{{optional($user)->id}}</td>



                            </tr>
                        @else
                            <tr>
                                <td>{{optional($user)->id}}</td>
                                <td>{{optional($user)->name}}</td>
                                <td>{{optional($user)->email}}</td>
                                <td>
                                    <?php

                                        $roles = optional($user->roles())->pluck('display_name')->toArray();

                                        foreach( $roles as $role)
                                           {
                                               ?>
                                               <label class="col-lg-6" style="     color: white;
    background-color: #04d848;
    padding: 3px 0px 4px 0px;
    border-radius: 6px;
    font-weight: bolder;
    font-size: 1pc;
    text-align: center;
    width: 42%;
    margin-right: 10px;">{{$role}}</label>
                                               <?php
                                           }
                                    ?>
                                </td>


                                <td style=" text-align: center">
                                    <a href="{{url('/users/'.optional($user)->id.'/edit')}}">
                                        <i class="fas fa-pen-square" style="color: #51a112;    font-size: 25px;"></i>
                                    </a>
                                </td>

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                                   [
                                                                        'url' =>'users/'.$user->id,
                                                                       'method'=>'DELETE'
                                                                   ])
                                                                !!}

                                    <button
                                            type = 'submit'
                                            class="fas fa-trash-alt"
                                            style="
                                                font-size: 21px;
                                                color: #b50000;
                                                background: #ffffff00;
                                                border: none;
                                            "
                                            onclick="return confirm('{{__('sofra.confirm_delete_user')}}');">

                                    </button>
                                    {!! Form::close() !!}

                                </td>
                            </tr>
                        @endCheckLang

                    @endforeach

                    </tbody>
                    <tfoot>
                        @CheckLang
                        <tr>
                            <th>{{__('sofra.delete')}}</th>
                            <th>{{__('sofra.edit')}}</th>
                            <th>{{__('sofra.role')}}</th>
                            <th>{{__('sofra.email')}}</th>
                            <th>{{__('sofra.name')}}</th>
                            <th>{{__('sofra.id')}}</th>
                        </tr>
                        @else
                        <tr>
                            <th>{{__('sofra.id')}}</th>
                            <th>{{__('sofra.name')}}</th>
                            <th>{{__('sofra.email')}}</th>
                            <th>{{__('sofra.role')}}</th>
                            <th>{{__('sofra.edit')}}</th>
                            <th>{{__('sofra.delete')}}</th>
                        </tr>
                        @endCheckLang
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        </section>

        @include('AdminDashBord.users.add')
@endsection



{{--**********************************************************************--}}

@section('script')


    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

@endsection

{{--**********************************************************************--}}