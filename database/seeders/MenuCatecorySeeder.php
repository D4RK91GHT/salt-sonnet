<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;

class MenuCatecorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuCategory::create(
            [
            'name' => 'Appetizers',
            'description' => 'Appetizers are small, flavorful dishes served before the main course to stimulate the appetite. Popular options include bruschetta, nachos, mozzarella sticks, spring rolls, and shrimp cocktail. They range from light (soups, salads) to indulgent (loaded fries, chicken wings). Many restaurants feature shareable platters, making them great for group dining. Some cuisines have signature starters, like samosas (Indian), edamame (Japanese), or calamari (Mediterranean).',
            'image' => 'appetizer.jpg',
            'status' => true,
        ]);

        MenuCategory::create(
            [
            'name' => 'Soups & Salads',
            'description' => 'This category includes light, refreshing, or hearty dishes that can serve as a starter or a main. Soups range from creamy bisques (tomato, lobster) to broths (pho, miso). Salads vary from simple greens (Caesar, Greek) to protein-packed options (grilled chicken, Cobb, or steak salads). Many restaurants offer seasonal soups and salads, incorporating fresh, local ingredients.',
            'image' => 'soup.jpg',
            'status' => true,
        ]);

        MenuCategory::create(
            [
            'name' => 'Sandwiches & Burgers',
            'description' => 'A staple in casual and fast-casual dining, this category includes classic burgers (beef, chicken, veggie), gourmet sandwiches (Reuben, club, panini), and sliders. Toppings like cheese, bacon, avocado, and specialty sauces enhance flavors. Many restaurants offer gluten-free buns or lettuce wraps for dietary preferences. Some feature signature burgers with unique ingredients (e.g., truffle aioli, fried eggs).',
            'image' => 'sandwich.jpg',
            'status' => true,
        ]);


        MenuCategory::create(
            [
            'name' => 'Pasta & Noodles',
            'description' => 'A beloved comfort food, pasta dishes include spaghetti, fettuccine Alfredo, lasagna, and ravioli, often with choices of protein (shrimp, chicken, meatballs). Asian noodle dishes like pad Thai, ramen, and lo mein are also popular. Many restaurants offer gluten-free or veggie-based pasta alternatives. Creamy, tomato-based, or oil-based sauces provide variety.',
            'image' => 'pasta.jpg',
            'status' => true,
        ]);


        MenuCategory::create(
            [
            'name' => 'Pizza & Flatbreads',
            'description' => 'A universal favorite, pizza comes in thin-crust, deep-dish, or wood-fired styles, with toppings ranging from pepperoni and mushrooms to gourmet options (prosciutto, arugula, truffle oil). Flatbreads are a lighter alternative, often with artisanal cheeses, roasted veggies, or grilled meats. Many pizzerias allow custom builds or offer signature pies.',
            'image' => 'pizza.jpg',
            'status' => true,
        ]);


        MenuCategory::create(
            [
            'name' => 'Seafood',
            'description' => 'Seafood dishes include grilled salmon, shrimp scampi, fish tacos, lobster rolls, and sushi/sashimi. Preparation styles vary—fried (fish & chips), steamed (mussels), or raw (ceviche, oysters). Many restaurants highlight daily catches or sustainable seafood. Coastal eateries often feature regional specialties like clam chowder or crab cakes.',
            'image' => 'seafood.jpg',
            'status' => true,
        ]);


        MenuCategory::create(
            [
            'name' => 'Meat & Poultry',
            'description' => 'This category includes steaks (filet mignon, ribeye), roasted chicken, pork chops, lamb dishes, and BBQ ribs. Cooking methods range from grilling and braising to smoking. Many steakhouses offer premium cuts with wine pairings, while casual spots serve comfort foods like fried chicken or meatloaf.',
            'image' => 'meat.jpg',
            'status' => true,
        ]);


        MenuCategory::create(
            [
            'name' => 'Vegetarian & Vegan',
            'description' => 'Plant-based dining has grown, with dishes like veggie burgers, tofu stir-fry, lentil curries, and jackfruit tacos. Many restaurants now offer vegan cheese, meat substitutes, and dairy-free desserts. Ethnic cuisines (Indian, Mediterranean) naturally feature vegetable-heavy dishes (falafel, dal, ratatouille).',
            'image' => 'vegetarian.jpg',
            'status' => true,
        ]);


        MenuCategory::create(
            [
            'name' => 'Desserts',
            'description' => 'Sweet endings include classics (chocolate cake, cheesecake, crème brûlée) and trendy options (molten lava cake, churros, macarons). Some restaurants offer dessert wines or coffee pairings. Ice cream sundaes, tiramisu, and fruit tarts are also common. Many now include gluten-free or vegan dessert choices.',
            'image' => 'dessert.jpg',
            'status' => true,
        ]);


        MenuCategory::create(
            [
            'name' => 'Beverages',
            'description' => 'Beyond water and soda, restaurants serve alcoholic (cocktails, beer, wine) and non-alcoholic (mocktails, smoothies, specialty coffees) drinks. Many feature signature cocktails, craft beers, or sommelier-curated wine lists. Some offer bottomless brunch drinks (mimosas, Bloody Marys) or artisanal teas and cold brews.',
            'image' => 'beverage.jpg',
            'status' => true,
        ]);
    }
}
