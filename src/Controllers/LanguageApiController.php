<?php

namespace Ssgroup\Language\Controllers;

use Ssgroup\ApiManager\Controllers\ApiBaseController;
use Ssgroup\Language\Trait\Publish;

class LanguageApiController extends ApiBaseController
{
    use Publish;

    public function index()
    {
        return response()->json(['error' => true], 200);
    }

    public function store()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function public()
    {
    }
}
