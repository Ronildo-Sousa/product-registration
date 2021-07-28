<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $categories = $this->repository->getAll();

        return response()->json(['categories' => $categories], Response::HTTP_OK);
    }


    public function store(CategoryRequest $request)
    {
        $category = $this->repository->store($request->validated());

        if ($category) {
            return response()->json(['category' => $category], Response::HTTP_CREATED);
        }
        return response()->json(['message' => 'Error to create category.'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }


    public function show($slug)
    {
        $category = $this->repository->show($slug);

        if ($category) {
            return response()->json(['category' => $category], Response::HTTP_OK);
        }
        return response()->json(['message' => 'Category not found.'], Response::HTTP_NOT_FOUND);
    }


    public function update(CategoryRequest $request, $slug)
    {
        $category = $this->repository->update($request->validated(), $slug);

        if ($category) {
            return response()->json(['category' => $category], Response::HTTP_OK);
        }
        return response()->json(['message' => 'Category not found.'], Response::HTTP_NOT_FOUND);
    }

    public function destroy($slug)
    {
        $isDelete = $this->repository->destroy($slug);

        if ($isDelete) {
            return response()->json(['message' => 'Category delete succesfully.'], Response::HTTP_OK);
        }
        return response()->json(['message' => 'Category not found.'], Response::HTTP_NOT_FOUND);
    }
}
