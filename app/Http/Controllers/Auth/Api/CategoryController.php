<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = $this->categoryRepository->getAll();
        return CategoryResource::collection($categories);
    }

    public function store(Request $request):  \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        dd("chegou!");
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        $category = $this->categoryRepository->create($data);
        return CategoryResource::collection($category);
    }

    public function show($id):  \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $category = $this->categoryRepository->getById($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        return CategoryResource::collection($category);
    }

    public function update(Request $request, $id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $data = $request->validate([
            'name' => 'string',
        ]);

        $category = $this->categoryRepository->update($id, $data);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        return CategoryResource::collection($category);
    }

    public function destroy($id): JsonResponse
    {
        $category = $this->categoryRepository->delete($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        return response()->json(['message' => 'Categoria removida com sucesso']);
    }

    public function news($id): ResourceCollection
    {
        $category = $this->categoryRepository->getById($id);

        if (!$category) {
            return response()->json(['message' => 'Categoria não encontrada'], 404);
        }

        $news = $category->news;
        return NewsResource::collection($news);
    }




}
