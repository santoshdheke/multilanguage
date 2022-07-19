<?php

namespace Ssgroup\Language\Controllers;

use Ssgroup\ApiManager\Controllers\ApiBaseController;
use Ssgroup\Language\Models\Language;
use Ssgroup\Language\Trait\Publish;

class LanguageController extends LanguageBaseController
{

    public $base_route = 'language';
    use Publish;

    public function index()
    {
        $data = [];
        $data['rows'] = Language::paginate(10);

        return view(parent::__loadView('index'), compact('data'));
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
