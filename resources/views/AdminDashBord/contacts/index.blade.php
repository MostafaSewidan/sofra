{{--***********************************************************************--}}

@extends('AdminDashBord.layouts.app')
<?php $contacts = \App\Models\Contact::all(); ?>

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
            {{__('sofra.Contact')}}
            <small>{{__('sofra.contact_page')}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/contacts')}}">{{__('sofra.contact')}}</a></li>
            <li><a href="{{url('/')}}"> {{__('sofra.home')}} <i class="fa fa-tachometer-alt"></i></a></li>

        </ol>
    </section>

    <br><br><br>
    @else
        <section class="content-header">
            <h1>
                {{__('sofra.Contact')}}
                <small>{{__('sofra.contact_page')}}</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}"><i class="fa fa-tachometer-alt"></i> {{__('sofra.home')}}</a></li>
                <li><a href="{{url('/contacts')}}">{{__('sofra.contact')}}</a></li>
            </ol>
        </section>

        <br><br><br>
        @endCheckLang

        <section class="content">

            <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{__('sofra.contacts_table')}}</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>

                        @CheckLang
                            <tr>
                                <th>{{__('sofra.delete')}}</th>
                                <th>{{__('sofra.details')}}</th>
                                <th>{{__('sofra.Email')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.id')}}</th>
                            </tr>
                        @else
                            <tr>
                                <th>{{__('sofra.id')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.Email')}}</th>
                                <th>{{__('sofra.details')}}</th>
                                <th>{{__('sofra.delete')}}</th>
                            </tr>
                        @endCheckLang

                    </thead>
                    <tbody>
                    @foreach( $contacts as $contact)
                        @CheckLang
                            <tr>

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                                    [
                                                                         'url' =>'contacts/'.$contact->id,
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
                                            onclick="return confirm('{{__('sofra.confirm_delete_contact')}}');">

                                    </button>

                                    {!! Form::close() !!}

                                </td>


                                <td style=" text-align: center">
                                    <a href="{{url('contacts/'.$contact->id)}}">
                                        <i class="fas fa-eye" style="    font-size: 25px;"></i>
                                    </a>
                                </td>

                                <td>
                                    {{optional($contact)->email}}
                                </td>

                                <td>{{optional($contact)->name}}</td>
                                <td>{{optional($contact)->id}}</td>



                            </tr>
                        @else
                            <tr>
                                <td>{{optional($contact)->id}}</td>
                                <td>{{optional($contact)->name}}</td>

                                <td>
                                    {{optional($contact)->email}}
                                </td>

                                <td style=" text-align: center">
                                    <a href="{{url('contacts/'.$contact->id)}}">
                                        <i class="fas fa-eye" style="    font-size: 25px;"></i>
                                    </a>
                                </td>

                                <td style=" text-align: center">
                                    {!! Form::open(
                                                                   [
                                                                        'url' =>'contacts/'.$contact->id,
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
                                            onclick="return confirm('{{__('sofra.confirm_delete_contact')}}');">

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
                                <th>{{__('sofra.details')}}</th>
                                <th>{{__('sofra.Email')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.id')}}</th>
                            </tr>
                        @else
                            <tr>
                                <th>{{__('sofra.id')}}</th>
                                <th>{{__('sofra.name')}}</th>
                                <th>{{__('sofra.Email')}}</th>
                                <th>{{__('sofra.details')}}</th>
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