<?php

namespace Application\Controllers;

use Application\Requests\SortRequest;
use Application\Services\Sort;
use Simple\Request;
use Simple\View;

class HomeController
{
    public function index(Request $request): View
    {
        return View::make('home');
    }

    public function sort(SortRequest $request): View
    {
        return View::make('home', [
            'sorted' => (new Sort(new ("Application\\Services\\{$request->get('strategy')}")))->sort(
                $request->get('value')
            )
        ]);
    }
}