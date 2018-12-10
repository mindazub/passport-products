<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Facades\PriceConvert;
use App\Http\Requests\ProductGenerateRequest;
use App\Http\Requests\ProductRequest;
use App\Jobs\GenerateRandomProductsJob;
use App\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $products = Product::query()->paginate();

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        Product::query()->create([
            'title' => $request->getTitle(),
            'price' => $request->getPrice(),
        ]);

        return redirect()
            ->route('product.index')
            ->with('status', 'Product created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param  \App\Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        Product::query()->findOrFail($product->id)->update($request->toArray());

        return redirect()->route('product.index')
            ->with('status', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        Product::query()->findOrFail($product->id)->delete();

        return redirect()->route('product.index')
            ->with('status', 'Product successfully deleted!');
    }

    public function generateDataForm(): View
    {
        return view('products.generate_form');
    }

    /**
     * @param ProductGenerateRequest $request
     * @return RedirectResponse
     */
    public function generateData(ProductGenerateRequest $request): RedirectResponse
    {
        GenerateRandomProductsJob::dispatch($request->getCount())->onQueue('create-products');


        return redirect()->route('product.index')
            ->with('status', 'Generate products data in few seconds');
        
    }
}
