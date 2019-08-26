@if(session()->get('fail'))
    <div class="alert alert" role="alert" style="font-size: 22px;
    font-weight: bolder;
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding-left: 4pc;">
        {{session()->get('fail')}}
    </div>
@endif
@if(session()->get('success'))
    <div class="alert alert" role="alert" style="
        padding-left: 4pc;
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        font-size: 22px;
        font-weight: bolder;">
        {{session()->get('success')}}
    </div>
@endif


@if ($errors->any())
    <div class="alert alert" role="alert" style="font-size: 22px;
    font-weight: bolder;
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
    padding-left: 4pc;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach

        </ul>
    </div>
@endif