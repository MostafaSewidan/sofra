@inject('perm',App\Models\Permission)
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    @CheckLang
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="box-title" style="    margin-right: 1pc;">{{__('sofra.add_role')}}</h3>

            <div class="box-body">

                {!! Form::model(
                                                                    [
                                                                         'url' =>'/roles',
                                                                        'method'=>'post'
                                                                    ])
                                                                 !!}

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.name')}}</label>
                    {!! Form::text('name' ,old('') ,['class'=>"form-control"]) !!}
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.display_name')}}</label>
                    {!! Form::text('display_name' ,old('') ,['class'=>"form-control"]) !!}
                </div>

                <div class="form-group">

                    <label for="exampleInputEmail1">{{__('sofra.description')}}</label>
                    <textarea name ='description' class="form-control" rows="3" style="text-align: right">{{old('description')}}</textarea>

                </div>
                <br><br>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.permissions')}}</label>
                    <br><br>
                    @foreach( $perm->all() as $permission)

                        <label class="col-lg-3">
                            <input type="checkbox" name="permission_list[]" value="{{$permission->id}}"> {{$permission->display_name}}
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
    @else
        <div class="modal-content" style="background-color: #fefefe;
    padding: 20px;
    border: 1px solid #888;
    width: 73%;
    margin-left: 21%;
    margin-top: -2pc;
    margin-bottom: 3pc;">
            <span class="close">&times;</span>
            <h3 class="box-title" style="    margin-left: 1pc;">{{__('sofra.Add_role')}}</h3>
            <br>

            <div class="box-body">
                {!! Form::model(
                                                                    [
                                                                         'url' =>'/roles',
                                                                        'method'=>'post'
                                                                    ])
                                                                 !!}

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.name')}}</label>
                    {!! Form::text('name' ,old('') ,['class'=>"form-control"]) !!}
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.display_name')}}</label>
                    {!! Form::text('display_name' ,old('') ,['class'=>"form-control"]) !!}
                </div>

                <div class="form-group">

                    <label for="exampleInputEmail1">{{__('sofra.description')}}</label>
                    <textarea name ='description' class="form-control" rows="3">{{old('description')}}</textarea>

                </div>
                    <br><br>
                <div class="form-group">
                    <label for="exampleInputEmail1">{{__('sofra.permissions')}}</label>
                    <br><br>
                        @foreach( $perm->all() as $permission)

                                    <label class="col-lg-3">
                                        <input type="checkbox" name="permission_list[]" value="{{$permission->id}}"> {{$permission->display_name}}
                                    </label>

                        @endforeach

                </div>

<br><br>
                <button type = 'submit' class="btn btn-primary"><i class="fas fa-plus"></i>{{__('sofra.Add')}}</button>
                {!! Form::close() !!}
            </div>
        </div>
    @endCheckLang


</div>