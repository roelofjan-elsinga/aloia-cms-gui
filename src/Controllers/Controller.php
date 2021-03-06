<?php

namespace AloiaCms\GUI\Controllers;

use AloiaCms\TagsParser;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class Controller
{
    public function __construct()
    {
        View::share('title', 'Aloia CMS');
        View::share('dashboard_url', Config::get('aloiacmsgui.dashboard_url'));
        View::share('website_url', Config::get('aloiacmsgui.website_url'));

        App::setLocale(Config::get('aloiacmsgui.language'));
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

    /**
     * Generate a LengthAwarePaginator instance
     *
     * @param Collection $items
     * @param string $url
     * @param int $for_page
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    protected function getPaginator(Collection $items, string $url, int $for_page = 1, int $per_page = 10): LengthAwarePaginator
    {
        return new LengthAwarePaginator(
            $items->forPage($for_page, $per_page),
            $items->count(),
            $per_page,
            $for_page,
            [
                'path' => $url
            ]
        );
    }
}
