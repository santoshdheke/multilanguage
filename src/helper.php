<?php

function language($key)
{
    return config('language.'.session('locale').'.'.$key) ?? $key;
}

function callLanguageStaticResources($data)
{
    return asset('language/'.$data);
}
