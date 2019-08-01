<?php

namespace FlatFileCms\GUI\Controllers;

use FlatFileCms\Taxonomy\Taxonomy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Contracts\View\View as ViewResponse;

class TaxonomyController extends Controller
{

    /**
     * Show the current taxonomy
     *
     * @return ViewResponse
     */
    public function index(): ViewResponse
    {
        $this->setTitle(_translate("MANAGE_TAXONOMY"));

        return View::make('flatfilecmsgui::taxonomy.index', [
            'taxonomy' => Taxonomy::get()
        ]);
    }

    /**
     * Store a new taxonomy entry
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Taxonomy::addChildToCategoryWithName($request->get('parent_category'), [
            'category_name' => $request->get('category_name'),
            'category_url_prefix' => $request->get('category_url_prefix'),
            'parent_category' => $request->get('parent_category'),
            'children' => []
        ]);

        return Redirect::route('taxonomy.index')->with('created', true);
    }

    /**
     * Update a taxonomy entry
     *
     * @param Request $request
     * @param string $category_url_prefix
     * @return RedirectResponse
     */
    public function update(Request $request, string $category_url_prefix): RedirectResponse
    {
        Taxonomy::updateCategoryWithUrlPrefix($category_url_prefix, [
            'category_name' => $request->get('category_name'),
            'category_url_prefix' => $request->get('category_url_prefix')
        ]);

        return Redirect::route('taxonomy.index')->with('updated', true);
    }

    public function destroy(string $category_name): RedirectResponse
    {
        // todo: 1. Change pages for this category to a parent category. If this is the highest item, remove category from page
        // todo: 2. Move all child categories to the parent category. If this is the highest item, make children main categories

        Taxonomy::destroy($category_name);

        return Redirect::route('taxonomy.index')->with('deleted', true);
    }
    
}