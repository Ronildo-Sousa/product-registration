<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ProductRepository
{
    public function all()
    {
        return Product::with(['image'])->paginate(6);
    }

    public function getAll()
    {
        $data = [];
        $categories = Category::all();

        foreach ($categories as $category) {
            $data[] = [
                'category' => $category,
                'products' => Product::where('category_id', $category->id)->with(['image'])->get()
            ];
        }

        return $data;
    }

    public function show(string $slug)
    {
        $product = Product::with(['category', 'image'])->where('slug', $slug)->first();

        if ($product) {
            return ['product' => $product];
        }
        return null;
    }

    public function store(array $payload)
    {
        return $payload['images'];
        // $payload['slug'] = $this->handleSlug(Str::slug($payload['name'], '-'));

        // $category = Category::find($payload['category_id']);

        // $product = $category->product()->create(Arr::except($payload, ['images']));
        // $this->storeImages($product, $payload['images']);

        // return $this->show($product->id);
    }

    public function update(array $payload, $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if ($product) {
            $payload['slug'] = $this->handleSlug('lou-douglas');
            $product->update($payload);

            return ['product' => $product];
        }

        return false;
    }

    public function search(string $search)
    {
        $products = Product::where('name', 'LIKE', '%' . $search . '%')->get();

        if ($products) {
            return ['products' => $products];
        }

        return null;
    }

    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if ($product) {
            $product->delete();

            return true;
        }
        return false;
    }

    private function handleSlug(string $slug)
    {
        while (Product::where('slug', $slug)->count() !== 0) {
            $slug = $slug . '-' . rand(0, 9999);
        }
        return $slug;
    }

    private function storeImages(Product $product, $images)
    {
        foreach ($images as $image) {
            $path = env('APP_URL') . '/storage/' . $image->store('products');
            $product->image()->create(['path' => $path]);
        }
    }
}
