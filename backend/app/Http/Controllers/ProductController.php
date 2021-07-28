<?php

namespace App\Http\Controllers;

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


    public function show($id)
    {
        $product = $this->repository->show($id);

        if ($product) {
            return response()->json(['data' => $product], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Product not found.'], Response::HTTP_NOT_FOUND);
    }


    public function update(StoreProductRequest $request, $id)
    {
        $productUpdate = $this->repository->update($request->all(), $id);

        if ($productUpdate) {
            return response()->json(['data' => $productUpdate], Response::HTTP_OK);
        }

        return response()->json(['message' => 'Product was not updated.'], Response::HTTP_NOT_FOUND);
    }


    public function destroy($id)
    {
        $isDestroy = $this->repository->destroy($id);

        if ($isDestroy) {
            return response()->json(['message' => 'Product deleted succesfully.'], Response::HTTP_OK);
        }
        return response()->json(['message' => 'Product not found.'], Response::HTTP_OK);
    }
}
