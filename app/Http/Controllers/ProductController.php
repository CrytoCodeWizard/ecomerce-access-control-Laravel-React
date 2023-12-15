<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id) {
        
        // show product logic

        return view("products.show", ["id" => $id]);
    }

    public function edit($id) {
        
        // edit product logic

        return view("products.edit", ["id" => $id]);
    }
}
