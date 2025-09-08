<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    // GET /api/cart/items
    public function index(Request $request)
    {
        $cart = $this->getOrCreateCart($request, false);
        if (!$cart) {
            return response()->json([
                'cart_id' => null,
                'items' => [],
                'count' => 0,
                'total' => 0,
            ]);
        }

        $items = $cart->items()->with(['menuItem.images', 'variations'])->latest()->get();

        return response()->json([
            'cart_id' => $cart->id,
            'items' => $items,
            'count' => $items->count(),
            // You can compute monetary total here if you have prices on relations
            'total' => 0,
        ])->withHeaders($this->cartHeaders($cart));
    }

    // POST /api/cart/items
    public function store(Request $request)
    {
        $data = $request->validate([
            'menu_item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'variation_ids' => 'nullable|array',
            'variation_ids.*' => 'integer',
        ]);

        $cart = $this->getOrCreateCart($request, true);

        $item = $cart->items()->create([
            'menu_item_id' => $data['menu_item_id'],
            'quantity' => $data['quantity'],
            'guest_identifier' => $this->guestIdentifier($request) ?? (string) Str::uuid(),
        ]);

        if (!empty($data['variation_ids'])) {
            $item->variations()->sync($data['variation_ids']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart',
            'cart_id' => $cart->id,
            'item' => $item->load(['menuItem', 'variations']),
        ], 201)->withHeaders($this->cartHeaders($cart));
    }

    // DELETE /api/cart/items/{id}
    public function destroy(Request $request, int $id)
    {
        $cart = $this->getOrCreateCart($request, false);
        if (!$cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found'], 404);
        }
        $item = $cart->items()->where('id', $id)->first();
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Item not found'], 404);
        }
        $item->variations()->detach();
        $item->delete();

        return response()->json(['success' => true, 'message' => 'Item removed']);
    }

    private function getOrCreateCart(Request $request, bool $create = true): ?Cart
    {
        $userId = Auth::id();
        // Avoid accessing session in API (no StartSession middleware by default)
        $sessionId = method_exists($request, 'hasSession') && $request->hasSession()
            ? $request->session()->getId()
            : null;
        // Prefer explicit guest id, generate if missing (kept in localStorage and sent via header)
        $guestId = $this->guestIdentifier($request) ?? (string) Str::uuid();

        $query = Cart::query();
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where(function ($q) use ($guestId, $sessionId) {
                $q->where('guest_identifier', $guestId);
                // Keep backward-compatibility: also try session id if it exists
                if ($sessionId) {
                    $q->orWhere('session_id', $sessionId);
                }
            });
        }

        $cart = $query->first();
        if (!$cart && $create) {
            $cart = Cart::create([
                'user_id' => $userId,
                'session_id' => $userId ? null : $sessionId,
                'guest_identifier' => $guestId,
            ]);
        }
        return $cart;
    }

    private function guestIdentifier(Request $request): ?string
    {
        // Accept a custom guest header or cookie, fallback to null - we generate if needed
        return $request->header('X-Guest-Id')
            ?? $request->cookie('guest_identifier')
            ?? null;
    }

    private function cartHeaders(Cart $cart): array
    {
        return [
            'X-Cart-Id' => (string) $cart->id,
        ];
    }
}
