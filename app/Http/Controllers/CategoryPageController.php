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

    public function categoryDetails($slug)
    {
        try {
            $categories = $this->menuCategoryService->index();
            $categoryDetails = $this->menuCategoryService->showBySlug($slug);
            $menuItems = $this->menuItemService->itemsByCategory($categoryDetails->id);
            return view('web.category-details', [
                'categories' => $categories,
                'category' => $categoryDetails,
                'menuItems' => $menuItems
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to load category page data: ' . $e->getMessage());
            return view('web.category-details', [
                'categories' => [],
                'category' => [],
                'menuItems' => [],
                'error' => 'Unable to load category data. Please try again later.'
            ]);
        }
    }
}