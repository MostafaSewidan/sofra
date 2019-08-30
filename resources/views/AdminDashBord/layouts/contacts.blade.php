
<?php
    $Complaints = \App\Models\Contact::where('is_read' , 'false')->where('type' , 'Complaint')->get();
    $Suggestions =\App\Models\Contact::where('is_read' , 'false')->where('type' , 'Suggestion')->get();
    $Enquirys =\App\Models\Contact::where('is_read' , 'false')->where('type' , 'Enquiry')->get();
    $contacts = \App\Models\Contact::where('is_read' , 'false');
?>

<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="contact_drop_menu">
        <i class="fas fa-envelope" style="font-size: 17px;"></i>
        @if($contacts->count() != 0 )
        <span class="label label-success">{{$contacts->count()}}</span>
        @endif
    </a>
    <ul  id="contact_menu">
        <li class="header" style="    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    background-color: #ffffff;
    padding: 7px 10px;
    border-bottom: 1px solid #f4f4f4;
    color: #444444;
    font-size: 14px;">You have {{$contacts->count()}} messages</li>
        <li>
            <!-- inner menu: contains the actual data -->


            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                <div style="    height: 2pc">
                    <a id="Complaint_button" class=" menu_button btn btn-dark col-lg-4 ">
                        Complaint
                        @if(count($Complaints))
                        <span class="label label-success">{{$Complaints->count()}}</span>
                        @endif
                    </a>
                    <a id="Suggestion_button" class=" menu_button btn btn-dark col-lg-4 ">
                        Suggestion
                        @if(count($Suggestions))
                        <span class="label label-success">{{$Suggestions->count()}}</span>
                        @endif
                    </a>
                    <a id="Enquiry_button" class=" menu_button btn btn-dark col-lg-4 ">
                        Enquiry
                        @if(count($Enquirys))
                        <span class="label label-success">{{$Enquirys->count()}}</span>
                        @endif
                    </a>
                </div>

                    {{--                *************************** (( Complaint )) *******************************--}}
                    <div id="Complaint">

                            <ul class="menu" style="overflow: auto; width: 100%; height: 200px;">

                                @if(!count($Complaints))
                                    <p class="p">{{__('sofra.no_messages')}}</p>
                                @endif
                            @foreach($Complaints as $Complaint )
                                <li><!-- start message -->
                                    <a href="{{url('contacts/'.$Complaint->id)}}">
                                        <div class="pull-left">
                                            <img src="{{asset($Complaint->contactable->image->name)}}" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            {{$Complaint->name}}
                                            <small class="pull-right" style="margin-right: 6px;"><i class="fa fa-clock-o"></i> {{$Complaint->created_at}}</small>
                                        </h4>
                                        <p>{{$Complaint->email}}</p>
                                    </a>
                                </li><!-- end message -->
                            @endforeach
                            </ul>

                    </div>
                    {{--                **************************************************************************--}}


{{--                *************************** (( Suggestion )) *******************************--}}
                <div id="Suggestion">
                    <ul class="menu" style="overflow: auto; width: 100%; height: 200px;">
                        @if(!count($Suggestions))
                            <p class="p">{{__('sofra.no_messages')}}</p>
                        @endif
                        @foreach($Suggestions as $Suggestion )
                            <li><!-- start message -->
                                <a href="{{url('contacts/'.$Suggestion->id)}}">
                                    <div class="pull-left">
                                        <img src="{{asset($Suggestion->contactable->image->name)}}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        {{$Suggestion->name}}
                                        <small class="pull-right" style="margin-right: 6px;"><i class="fa fa-clock-o"></i> {{$Suggestion->created_at}}</small>
                                    </h4>
                                    <p>{{$Suggestion->email}}</p>
                                </a>
                            </li><!-- end message -->
                        @endforeach

                    </ul>
                </div>
{{--                **************************************************************************--}}

{{--                *************************** (( Enquiry )) *******************************--}}
                <div id="Enquiry">
                    <ul class="menu" style="overflow: auto; width: 100%; height: 200px;">
                        @if(!count($Enquirys))
                            <p class="p">{{__('sofra.no_messages')}}</p>
                        @endif
                        @foreach($Enquirys as $Enquiry )
                            <li><!-- start message -->
                                <a href="{{url('contacts/'.$Enquiry->id)}}">
                                    <div class="pull-left">
                                        <img src="{{asset($Enquiry->contactable->image->name)}}" class="img-circle" alt="User Image">
                                    </div>
                                    <h4>
                                        {{$Enquiry->name}}
                                        <small class="pull-right" style="margin-right: 6px;"><i class="fa fa-clock-o"></i> {{$Enquiry->created_at}}</small>
                                    </h4>
                                    <p>{{$Enquiry->email}}</p>
                                </a>
                            </li><!-- end message -->
                        @endforeach
                    </ul>
                </div>
{{--                **************************************************************************--}}

            <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
        </li>
        <li class="footer" style="    text-align: center;
    padding-top: 5px;
    border-top: 1px solid #cccccc8a;"><a href="{{url('/contacts')}}" style="padding: 0.5pc 6pc 0pc 6pc;
    font-size: 11px;
    color: black;">{{__('sofra.See_All_Messages')}}</a></li>
    </ul>
</li>