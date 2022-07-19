<?php

namespace Ssgroup\Language\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class LanguageBaseController extends Controller
{
    public $theme_path = 'ssgrouplanguage::theme_one';

    public $view_path = 'language';

    public $title = 'Language';

    public $base_route;

    public function __loadView($view)
    {
        $view = $this->theme_path.'.'.$this->view_path.'.'.$view;
        View::composer($view, function ($view) {
            $view->with('theme_path', $this->theme_path);
            $view->with('view_path', $this->theme_path.'.'.$this->view_path.'.');
            $view->with('title', $this->title);
            $view->with('base_route', 'ssgroup-language.'.$this->base_route.'.');
        });

        return $view;
    }

    public function returnBack($response, $request)
    {
        if (isset($response['status']) && $response['status'] == 'error') {
            if (isset($response['status_code']) && in_array($response['status_code'], [400,404,403])) {
                abort($response['status_code']);
            } else {
                abort(500);
            }
        }

        if (isset($response['status']) && $response['status'] == 'child') {
            return redirect()->back()->with('error', $response['message'] ?? $this->title.' Update Successful.');
        }

        if ($request->save) {
            return redirect()->route('ssgroup-language.'.$this->base_route.'.index')->with('success', $response['message'] ?? $this->title.' Update Successful.');
        }

        return redirect()->back()->with('success', $response['message'] ?? $this->title.' Update Successful.');
    }
}
