<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Services\MenuItemService;
use App\Services\MenuCategoryService;

class CategoryPageController extends Controller
{

    public function __construct(
        protected MenuItemService $menuItemService,
        protected MenuCategoryService $menuCategoryService
    ) {
    }
    public function categoryPage()
    {
        return view('web.category');
    }
}