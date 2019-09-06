@inject('roles',App\Models\Role)
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    @CheckLang
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="box-title" style="    margin-right: 1pc;">{{__('sofra.add_user')}}</h3>

            <div class="box-body">

                {!! Form::open(
                                                                    [
                                                                         'url' =>'/users',
                                                                        'method'=>'post',
                                                                        'files'=> 'true'
                                                                    ])
                                                                 !!}

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.name')}}</label>
                    {!! Form::text('name' ,old('name') ,['class'=>"form-control"]) !!}
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.email')}}</label>
                    {!! Form::text('email' ,old('email') ,['class'=>"form-control"]) !!}
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
                    <label for="exampleInputFile">{{__('sofra.Image')}}</label>


                    {!! Form::file('img') !!}

                </div>

                <br><br>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.roles')}}</label>
                    <br><br>
                    @foreach( $roles->all() as $role)

                        <label class="col-lg-3">
                            <input type="checkbox" name="roles_list[]" value="{{$role->id}}"> {{$role->display_name}}
                        </label>

                    @endforeach

                </div>

                <br><br>
                <button type = 'submit' class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    {{__('sofra.Add')}}
                </button>
                {!! Form::close() !!}


            </div>
        </div>

    {{--        *************************************************************--}}

@else

{{--        *************************************************************--}}

        <div class="modal-content" style="background-color: #fefefe;
    padding: 20px;
    border: 1px solid #888;
    width: 73%;
    margin-left: 21%;
    margin-top: -2pc;
    margin-bottom: 3pc;">
            <span class="close">&times;</span>
            <h3 class="box-title" style="    margin-left: 1pc;">{{__('sofra.Add_user')}}</h3>
            <br>

            <div class="box-body">

                {!! Form::open(
                                                                    [
                                                                         'url' =>'/users',
                                                                        'method'=>'post',
                                                                        'files'=> true
                                                                    ])
                                                                 !!}

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.name')}}</label>
                    {!! Form::text('name' ,old('name') ,['class'=>"form-control"]) !!}
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.email')}}</label>
                    {!! Form::text('email' ,old('email') ,['class'=>"form-control"]) !!}
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
                    <label for="exampleInputFile">{{__('sofra.Image')}}</label>


                    {!! Form::file('img') !!}

                </div>

                <br><br>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.roles')}}</label>
                    <br><br>
                    @foreach( $roles->all() as $role)

                        <label class="col-lg-3">
                            <input type="checkbox" name="roles_list[]" value="{{$role->id}}"> {{$role->display_name}}
                        </label>

                    @endforeach

                </div>

                <br><br>
                <button type = 'submit' class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    {{__('sofra.Add')}}
                </button>
                {!! Form::close() !!}

            </div>
        </div>
    @endCheckLang


</div>