<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Services\MenuItemService;
use App\Services\MenuCategoryService;
use App\Models\MenuCategory;

class HomePageController extends Controller
{

    public function __construct(
        protected MenuItemService $menuItemService,
        protected MenuCategoryService $menuCategoryService
    ) {
    }

    public function homePage()
    {
        try {
            $menuItems = $this->menuItemService->index();
            $categories = $this->menuCategoryService->index();
            // dd($categories);
            return view('web.home', [
                'items' => $menuItems['menuItems'],
                'categories' => $categories
            ]);
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('Failed to load home page data: ' . $e->getMessage());
            return view('web.home', [
                'items' => [],
                'categories' => [],
                'error' => 'Unable to load menu data. Please try again later.'
            ]);
        }
    }
}
