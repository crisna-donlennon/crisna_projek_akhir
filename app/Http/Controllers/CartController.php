<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        $cart = Cart::findOrFail(auth()->id());
        return view('cart', [compact('cart')]);
    }
    public function addToCart(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_product' => 'required|exists:products,id',
            'jumlah' => 'required|numeric|min:1',
        ]);

        // Assuming you have a Product model
        $product = Product::findOrFail($request->id_product);

        // Get the current user's ID
        $userId = auth()->id();

        // Check if the product is already in the cart for the user
        $cartItem = Cart::where('id_user', $userId)
            ->where('id_product', $product->id)
            ->first();

        if ($cartItem) {
            // If the product is already in the cart, update the jumlah
            $cartItem->jumlah += $request->jumlah;
            $cartItem->save();
        } else {
            // If the product is not in the cart, create a new cart item
            Cart::create([
                'id_user' => $userId,
                'id_product' => $product->id,
                'jumlah' => $request->jumlah,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Item added to cart successfully!');
    }

    public function CartView(Request $request,)
    {
        $cartItems = Cart::with('product')->where('id_user', auth()->id())->get();
    
        $totalPrice = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->harga * $cartItem->jumlah;
        });
    
        return view('cart', compact('cartItems', 'totalPrice'));
    }


    // public function delete(Request $request)
    // {
    //     $productId = $request->input('productId');

    //     // Assuming you have a Cart model, fetch the cart item from the database
    //     $cartItem = Cart::where('id_product', $productId)
    //         ->first();

    //     if ($cartItem) {
    //         // Remove the item from the database
    //         $cartItem->delete();
    //         return redirect()->route('cart')->with('success', 'Product removed from cart successfully.');
    //     }

    //     return redirect()->route('cart')->with('error', 'Product not found in cart.');
    // }

    // public function delete(Request $request)
    // {
    //     $productId = $request->input('productId');
    
    //     // Assuming you have a Cart model, fetch the cart item from the database
    //     $cartItem = Cart::where('id_product', $productId)
    //         ->where('id_user', auth()->id())
    //         ->first();
    
    //     if ($cartItem) {
    //         // Remove the item from the database
    //         $cartItem->delete();
    //         return redirect()->route('cart')->with('success', 'Product removed from cart successfully.');
    //     }
    
    //     return redirect()->route('cart')->with('error', 'Product not found in cart.');
    // }
    
    
    // public function delete(Request $request, $id)
    // {
    //     $action = $request->input('action');
    //     $cart = Cart::find($id);

    //     if ($cart) {
    //         $cart->delete();
    //         return redirect('/cart')->with('success', 'Post deleted successfully');
    //     } else {
    //         return redirect('/cart')->with('error', 'Post not found');
    //     }
    // }

    public function delete($productId)
    {
        $cart = Cart::findorFail($productId);

        if ($cart) {
            $cart->delete();
            return redirect('/cart')->with('success', 'Post deleted successfully');
        } else {
            return redirect('/home')->with('error', 'Post not found');
        }
    }

    // UPDATE
    public function update(Request $request, $productId)
    {
        $action = $request->input('action');
        $cart = Cart::find($productId);
        if (!$cart) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }
        if($action == 'increase'){
            $cart->update([
                'jumlah' => $cart->jumlah + 1
            ]);
        }
        if($action == 'decrease'){
            $cart->update([
                'jumlah' => $cart->jumlah - 1
            ]);
        }
        
        if($cart->jumlah == 0){
            $cart->delete();
        }
        return redirect()->route('cart')->with('success', 'Cart updated successfully.');

        // Assuming you have a Cart model, fetch the cart item from the database
        // $cartItem = Cart::where('id_product', $productId)
        //     ->first();

        // if ($cartItem) {
        //     // Check if the action is an increase or decrease
        //     if ($action == 'increase') {
        //         // Check if increasing the jumlah will exceed the stok
        //         if ($cartItem->jumlah < $product->stok) {
        //             // Increase the jumlah
        //             $cartItem->jumlah += 1;
        //         } else {
        //             return redirect()->route('cart', )->with('error', 'Maximum stok reached.');
        //         }
        //     } elseif ($action == 'decrease' && $cartItem->jumlah > 1) {
        //         // Decrease the jumlah (minimum 1)
        //         $cartItem->jumlah -= 1;
        //     }

        //     // Update the price based on the changed jumlah
        //     //$cartItem->price = $product->price * $cartItem->jumlah;

        //     // Save the changes to the database
        //     $cartItem->save();
        // }

    }
}