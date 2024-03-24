<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Product;
use App\Utils\ImageUpload;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\ProductRequest;
use Cart;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('dashboard.products.index');
    }

    public function show($id)
    {
        $product = $this->productService->getById($id, true);
        return view('dashboard.products.show', compact('product'));
    }

    public function getall()
    {
        return $this->productService->dataTable();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getMainCategories();
        return view('dashboard.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $this->productService->store($request->validated());
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->categoryService->getMainCategories();
        $product = $this->productService->getById($id, true);
        return view('dashboard.products.edit', compact('categories', 'product'));
    }

    public function update(ProductRequest $request, string $id)
    {
        $this->productService->update($id, $request->validated());
        return redirect()->route('dashboard.products.index')->with('success', 'تمت الاضافة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(ProductRequest $request)
    {
        $this->productService->delete($request->id);
        return redirect()->route('dashboard.products.index');
    }




    public function cart()
    {
        $products = Product::limit(2)->get();
        $user = User::first();
        Auth::setUser($user);
        $user = Auth::user();
        $userId = $user->id;

        Cart::session($userId)->clear();

        $condition1 = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'tax 15%',
            'type' => 'tax',
            'value' => '15%',
        ));

        $coupon = new \Darryldecode\Cart\CartCondition(array(
            'name' => 'SALE 10%',
            'type' => 'sale',
            'value' => '-10%',
        ));

        /* a way to add products to cart
            foreach ($products as $key => $product) {
                Cart::session($user->id)->add(
                    array(
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $key + 1,
                        'attributes' => array(),
                        'associatedModel' => $product

                )

            );
        }*/

        //another way to add products to cart (best practice)

        $addToCart = [];
        foreach ($products as $key => $product) {
            $addToCart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $key + 1,
                'attributes' => array(),
                'associatedModel' => $product,
                'conditions' => [$condition1,$coupon],

            ];
        }

        Cart::session($userId)->add($addToCart);
        Cart::session($userId)->update($products[0]->id, array(
            'name' => 'ssas',
        ));
        $cartContent = Cart::session($userId)->getContent()->toarray();
        // foreach ($cartContent as $key => $value) {
        //     echo $value['name'] . " : " . $value['price'] . " : " . $value['quantity'] . "<br>";
        // }
        $total = Cart::session($userId)->getTotal();
        dd($cartContent, $total,);
    }
}
