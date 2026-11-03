<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        return view('dashboard', [
            'productCount' => db_connect()->table('products_info')->countAllResults(),
            'userCount'    => db_connect()->table('user_info')->countAllResults(),
        ]);
    }
}
