
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    @CheckLang
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="box-title" style="    margin-right: 1pc;">{{__('sofra.Add_category')}}</h3>

            <div class="box-body">

                {!! Form::open(
                                                                    [
                                                                         'url' =>'/categories',
                                                                        'method'=>'post'
                                                                    ])
                                                                 !!}
                {!! Form::text('name' ,old('') ,['class'=>"form-control" , 'style'=>'text-align: right;']) !!}
                <br>
                <button type = 'submit' class="btn btn-primary">{{__('sofra.Add')}} <i class="fas fa-plus"></i></button>
                {!! Form::close() !!}

            </div>
        </div>
    @else
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 class="box-title" style="    margin-left: 1pc;">{{__('sofra.Add_form')}}</h3>

            <div class="box-body">
                {!! Form::open(
                                                                    [
                                                                         'url' =>'/categories',
                                                                        'method'=>'post'
                                                                    ])
                                                                 !!}
                {!! Form::text('name' ,old('') ,['class'=>"form-control"]) !!}
                <br>
                <button type = 'submit' class="btn btn-primary"><i class="fas fa-plus"></i>{{__('sofra.Add')}}</button>
                {!! Form::close() !!}
            </div>
        </div>
    @endCheckLang


</div>