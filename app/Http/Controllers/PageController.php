<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function singleProduct()
    {
        return view('client.single-product');
    }

    public function checkout()
    {
        return view('client.checkout');
    }

    public function category()
    {
        return view('client.category');
    }

    public function confirmation()
    {
        return view('client.confirmation');
    }

    public function contactProccess()
    {
        return view('client.contact_proccess');
    }
}
