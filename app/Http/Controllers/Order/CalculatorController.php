<?php

namespace App\Http\Controllers\Order;

use App\Carrier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Functions;

class CalculatorController extends Controller
{
    public function calculator(Request $request)
    {
        $functions = new Functions();
        return $functions->calculateCost($request);
    }
}
