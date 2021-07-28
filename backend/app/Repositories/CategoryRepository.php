<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Str;
use Exception;

class CategoryRepository
{
    public function getAll()
    {
        return Category::all();
    }

    public function show(int $id)
    {
        $category = Category::find($id);

        if ($category) {
            return $category;
        }

        return null;
    }

    public function store(array $payload)
    {
        try {
            $payload['slug'] = $this->handleSlug(Str::slug($payload['name'], '-'));
            $category = Category::create($payload);
            return $category;
        } catch (Exception $e) {
            return  null;
        }
    }

    public function update(array $payload, int $id)
    {
        $category = Category::find($id);

        if ($category) {
            $payload['slug'] = $this->handleSlug(Str::slug($payload['name'], '-'));
            $category->update($payload);

            return $category;
        }
        return null;
    }

    public function destroy(int $id)
    {
        $category = Category::find($id);

        if ($category) {
            $category->delete();

            return true;
        }
        return null;
    }


    private function handleSlug(string $slug)
    {
        while (Category::where('slug', $slug)->count() !== 0) {
            $slug = $slug . '-' . rand(0, 9999);
        }
        return $slug;
    }
}
