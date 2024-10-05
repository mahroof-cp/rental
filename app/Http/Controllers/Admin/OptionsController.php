<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Cms\CmsRepository as CmsRepository;

class OptionsController extends Controller
{

    public function cmsCategories(CmsRepository $cmsRepo, Request $request)
    {
        $term = trim($request->q);
        $not = trim($request->not);
        $categories = $cmsRepo->searchCmsCategory($term, $not);
        $categoryOptions = [];
        foreach ($categories as $category) {
            $categoryOptions[] = ['id' => $category->id, 'text' => $category->name];
        }
        return response()->json($categoryOptions);
    }
}