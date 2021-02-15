<?php

namespace App\Http\Controllers;

use App\About;
use App\Faq;
use App\Privacy;
use App\Term;
use App\CarrierFaq;
use App\ShipperFaq;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function terms(){
return response()->json(Term::first());

    }
    public function privacy(){
return response()->json(Privacy::first());

    }
    public function faq(){
return response()->json(Faq::first());

    }
    public function carrierFaq(){
return response()->json(carrierFaq::all());

    }
    public function shipperFaq(){
return response()->json(ShipperFaq::all());

    }
    public function about(){
return response()->json(About::first());

    }
}
