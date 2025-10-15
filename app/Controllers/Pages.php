<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Pages extends Controller
{
    public function about()
    {
        $data['user'] = logged_in() ? user() : null;
        
        return view('templates_customer/header', $data)
            . view('pages/about')
            . view('templates_customer/footer');
    }
    public function faq()
    {
        $data['user'] = logged_in() ? user() : null;
        
        return view('templates_customer/header', $data)
            . view('pages/faq')
            . view('templates_customer/footer');
    }
    public function contact()
    {
        $data['user'] = logged_in() ? user() : null;
        
        return view('templates_customer/header', $data)
            . view('pages/contact')
            . view('templates_customer/footer');
    }
}