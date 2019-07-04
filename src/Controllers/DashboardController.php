<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\Article;

class DashboardController extends Controller
{
    public function index()
    {
        return view('flatfilecmsgui::index');
    }
}