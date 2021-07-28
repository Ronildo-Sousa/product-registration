<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository =  $repository;
    }

    public function index()
    {
        $products = $this->repository->getAll();

        return response()->json(['categories' => $products], Response::HTTP_OK);
    }


    public function store(StoreProductRequest $request)
    {
        $product = $this->repository->store($request->all());

        return response()->json(['data' => $product], Response::HTTP_CREATED);
    }


    public function show($slug)
    {
        $product = $this->repository->show($slug);

        if ($product) {
            return response()->json(['data' => $product], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Product not found.'], Response::HTTP_NOT_FOUND);
    }


    public function update(StoreProductRequest $request, $slug)
    {
        $productUpdate = $this->repository->update($request->all(), $slug);

        if ($productUpdate) {
            return response()->json(['data' => $productUpdate], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Product was not updated.'], Response::HTTP_NOT_FOUND);
    }

    public function search(SearchRequest $request)
    {
        $products = $this->repository->search($request->search);

        if ($products) {
            return response()->json(['data' => $products], Response::HTTP_OK);
        }
        return response()->json(['message' => 'Product not found.'], Response::HTTP_NOT_FOUND);
    }


    public function destroy($slug)
    {
        $isDestroy = $this->repository->destroy($slug);

        if ($isDestroy) {
            return response()->json(['message' => 'Product deleted succesfully.'], Response::HTTP_OK);
        }
        return response()->json(['message' => 'Product not found.'], Response::HTTP_OK);
    }
}
