<?php

namespace STS\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use STS\Http\Controllers\Controller;
use STS\Contracts\Logic\Routes as RoutesLogic;
use Carbon\Carbon;

class RoutesController extends Controller
{
    public function __construct(RoutesLogic $routesLogic)
    {
        $this->middleware('logged', ['except' => ['autocomplete']]);
        $this->routesLogic = $routesLogic;
    }

    public function autocomplete(Request $request) 
    {
        // TODO pagination / return errors 
        $data = $request->all();
        if (isset($data['name']) && isset($data['country']) && isset($data['multicountry'])) {
            $node = $this->routesLogic->autocomplete($data['name'], $data['country'], ($data['multicountry'] === 'true'));
            return $node;
        }
    }
}