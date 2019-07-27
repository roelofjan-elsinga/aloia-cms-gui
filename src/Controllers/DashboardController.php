<?php

namespace FlatFileCms\GUI\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewResponse;

class DashboardController extends Controller
{
    /**
     * Show the dashboard
     *
     * @return ViewResponse
     */
    public function index(): ViewResponse
    {
        $this->setTitle("Dashboard");

        return View::make('flatfilecmsgui::index');
    }
}