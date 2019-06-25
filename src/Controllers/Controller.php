<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\TagsParser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class Controller
{

    public function __construct()
    {
        View::share('page', TagsParser::instance()->getTagsForPageName('default'));
        View::share('dashboard_url', Config::get('flatfilecmsgui.dashboard_url'));
        View::share('website_url', Config::get('flatfilecmsgui.website_url'));
    }

}
