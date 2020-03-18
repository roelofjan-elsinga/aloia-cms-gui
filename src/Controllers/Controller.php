<?php

namespace AloiaCms\GUI\Controllers;

use AloiaCms\TagsParser;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class Controller
{
    public function __construct()
    {
        View::share('title', 'Flat File CMS');
        View::share('dashboard_url', Config::get('aloiacmsgui.dashboard_url'));
        View::share('website_url', Config::get('aloiacmsgui.website_url'));
    }

    /**
     * Set the page title for the current page
     *
     * @param string $title
     * @param bool $include_suffix
     */
    protected function setTitle(string $title, bool $include_suffix = true): void
    {
        if ($include_suffix) {
            $site_name = Config::get('app.name');

            $title .= " - {$site_name}";
        }

        View::share('title', $title);
    }
}
