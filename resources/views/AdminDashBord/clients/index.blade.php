{{--***********************************************************************--}}

@extends('AdminDashBord.layouts.app')
@inject('user' , App\Models\Client)
@inject('restaurant' , App\Models\Resturant)
<?php $clients = \App\Models\Client::all(); ?>

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
            background-color: rgba(0,0,0,0.4); /* Black w/ opaclient */
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
            {{__('sofra.Client')}}
            <small>{{__('sofra.client_page')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/clients')}}">{{__('sofra.client')}}</a></li>
            <li><a href="{{url('/')}}"> {{__('sofra.home')}} <i class="fa fa-tachometer-alt"></i></a></li>

        </ol>
    </section>

    <br><br><br>
    @else
        <section class="content-header">
            <h1>
                {{__('sofra.Client')}}
                <small>{{__('sofra.client_page')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-tachometer-alt"></i> {{__('sofra.home')}}</a></li>
                <li><a href="{{url('/clients')}}">{{__('sofra.client')}}</a></li>
            </ol>
        </section>

        <br><br><br>
        @endCheckLang

        <section class="content">


            <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{__('sofra.clients_table')}}</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>

                        @CheckLang
                            <tr>
                                <th>{{__('sofra.delete')}}</th>
                                <th>{{__('sofra.activation')}}</th>
                                <th>{{__('sofra.details')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.email')}}</th>
                                <th>{{__('sofra.id')}}</th>
                            </tr>
                        @else
                            <tr>
                                <th>{{__('sofra.id')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.email')}}</th>
                                <th>{{__('sofra.details')}}</th>
                                <th>{{__('sofra.activation')}}</th>
                                <th>{{__('sofra.delete')}}</th>
                            </tr>
                        @endCheckLang

                    </thead>
                    <tbody>
                    @foreach( $clients as $client)
                        @CheckLang
                            <tr>

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                                   [
                                                                        'url' =>'clients/'.$client->id,
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
                                            onclick="return confirm('{{__('sofra.Please_confirm_delete')}}');">

                                    </button>
                                    {!! Form::close() !!}

                                </td>s

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                [
                                                    'url' => '/clients/'.$client->id,
                                                    'method'=>'PUT'
                                                ]
                                        ) !!}
                                    @if($client->activation_report == 'active')


                                        <button type="submit" class="btn btn-danger" style="    font-size: 16px;
    font-weight: 900; width: 100px">
                                            <i class="fas fa-ban"></i>
                                            {{__('sofra.block')}}
                                        </button>
                                    @else
                                        <button type="submit" class="btn btn-success" style="    font-size: 16px;
    font-weight: 900;">
                                            <i class="fas fa-key"></i>
                                            {{__('sofra.activate')}}
                                        </button>
                                    @endif
                                    {!! Form::close() !!}
                                </td>

                                <td style=" text-align: center">
                                    <a href="{{url('clients/'.$client->id.'')}}">
                                        <i class="fas fa-eye" style="    font-size: 25px;"></i>
                                    </a>
                                </td>

                                <td>{{optional($client)->email}}</td>
                                <td>{{optional($client)->name}}</td>
                                <td>{{optional($client)->id}}</td>



                            </tr>
                        @else
                            <tr>
                                <td>{{optional($client)->id}}</td>
                                <td>{{optional($client)->name}}</td>
                                <td>{{optional($client)->email}}</td>

                                <td style=" text-align: center">
                                    <a href="{{url('clients/'.$client->id.'')}}">
                                        <i class="fas fa-eye" style="    font-size: 25px;"></i>
                                    </a>
                                </td>

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                [
                                                    'url' => '/clients/'.$client->id,
                                                    'method'=>'PUT'
                                                ]
                                        ) !!}
                                    @if($client->activation_report == 'active')


                                    <button type="submit" class="btn btn-danger" style="    font-size: 16px;
    font-weight: 900; width: 100px">
                                        <i class="fas fa-ban"></i>
                                        {{__('sofra.block')}}
                                    </button>
                                    @else
                                        <button type="submit" class="btn btn-success" style="    font-size: 16px;
    font-weight: 900;">
                                            <i class="fas fa-key"></i>
                                            {{__('sofra.activate')}}
                                        </button>
                                    @endif
                                    {!! Form::close() !!}
                                </td>

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                                   [
                                                                        'url' =>'clients/'.$client->id,
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
                                            onclick="return confirm('{{__('sofra.Please_confirm_delete')}}');">

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
                                <th>{{__('sofra.activation')}}</th>
                                <th>{{__('sofra.details')}}</th>
                                <th>{{__('sofra.email')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.id')}}</th>
                            </tr>
                        @else
                            <tr>
                                <th>{{__('sofra.id')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.email')}}</th>
                                <th>{{__('sofra.details')}}</th>
                                <th>{{__('sofra.activation')}}</th>
                                <th>{{__('sofra.delete')}}</th>
                            </tr>
                        @endCheckLang
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        </section>

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