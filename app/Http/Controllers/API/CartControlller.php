<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product_Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartControlller extends Controller
{
    //

    public function addToCart(Request $req)
    {

        if (auth()->user()) {
            $user_id = auth()->user()->id;
            $product_id = $req->product_id;
            $product_qty = $req->product_qty;

            $checkCart = Product_Color::where('id', $product_id)->first();
            if ($checkCart) {

                if (Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
                    return response()->json([
                        'status' => 409,
                        "message" => "Already Add to Cart"
                    ]);
                } else {
                    $cartItem = new Cart;
                    $cartItem->user_id = $user_id;
                    $cartItem->product_id = $product_id;
                    $cartItem->product_qty = $product_qty;
                    $cartItem->save();

                    return response()->json([
                        'status' => 201,
                        "message" => "Add to Cart"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 404,
                    "message" => "Product Not Found"
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                "message" => "Login to Add to Cart"
            ]);
        }
    }

    public function viewCart()
    {

        if (auth()->user()) {
            $user_id = auth()->user()->id;

            // $cart = Cart::where('user_id', $user_id)->get();
            $cart = DB::table('cart')->join('product_color', 'cart.product_id', '=', 'product_color.id')->join('products', 'product_color.product_id', '=', 'products.id')->join('color', 'product_color.color_id', '=', 'color.id')->select('cart.*', 'product_color.price', 'products.name as productName', 'products.photo', 'products.weight', 'products.unit', 'color.name as colorName', 'color.color', 'product_color.qty as qty')->where('user_id', $user_id)->get();
            return response()->json([
                'status' => 200,
                "cart" => $cart
            ]);
        } else {
            return response()->json([
                'status' => 401,
                "message" => "Login to View Cart"
            ]);
        }
    }

    public function updateQuantity($cart_id, $scope)
    {
        if (auth()->user()) {
            $user_id = auth()->user()->id;
            $cartItem = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();

            if ($scope == 'dec') {
                $cartItem->product_qty -= 1;
            } else if ($scope == 'inc') {
                $cartItem->product_qty += 1;
            }
            $cartItem->update();
            return response()->json([
                'status' => 200,
                "message" => "Quantity Updated"
            ]);
        } else {
            return response()->json([
                'status' => 401,
                "message" => "Login to Update Cart Item"
            ]);
        }
    }

    public function deleteCart($cart_id)
    {
        if (auth()->user()) {
            $user_id = auth()->user()->id;
            $cartItem = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();

            if ($cartItem) {
                $cartItem->delete();
                return response()->json([
                    'status' => 200,
                    "message" => "Cart Item Removed Successfully"
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                "message" => "Login to Remove Cart Item"
            ]);
        }
    }
}
