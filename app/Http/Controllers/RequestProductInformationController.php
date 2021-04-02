<?php

namespace App\Http\Controllers;

class RequestProductInformationController extends Controller
{
    public function create()
    {
        return view('request_product_info.create');
    }
}