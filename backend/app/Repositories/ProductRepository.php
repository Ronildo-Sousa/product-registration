<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductRepository
{
    public function getAll()
    {
        return Product::with(['category', 'image'])->paginate(5);
    }

    public function show(int $id)
    {
        $product = Product::with(['category', 'image'])->find($id);

        if ($product) {
            return ['product' => $product];
        }
        return null;
    }

    public function store(array $payload)
    {
        $payload['slug'] = $this->handleSlug(Str::slug($payload['name'], '-'));

        $category = Category::find($payload['category_id']);

        $product = $category->product()->create(Arr::except($payload, ['images']));
        $this->storeImages($product, $payload['images']);

        return $this->show($product->id);
    }

    public function update(array $payload, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $payload['slug'] = $this->handleSlug('lou-douglas');
            $product->update($payload);

            return ['product' => $product];
        }

        return false;
    }

    public function destroy($id)
    {
        $product = Product::find($id);

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
