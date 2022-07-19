<?php

function language($key)
{
    return config('language.'.session('locale').'.'.$key) ?? $key;
}
