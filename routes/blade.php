<?php
\Illuminate\Support\Facades\Blade::if('CheckLang' , function ()
{
    if(\Illuminate\Support\Facades\App::getLocale() == 'ar')
    {
        return true;
    }else{
        return false;
    }
});