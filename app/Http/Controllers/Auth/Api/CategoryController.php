<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
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

    public function store(CategoryCreateRequest $request):  JsonResponse
    {
        try{
            $data = $request->validated();

            $category = $this->categoryRepository->create($data);
            return response()->json($category, 201);
        }catch (\Exception $e){
            return response()->json(['message' => 'Erro ao criar categoria'], 500);
        }

    }

    public function show($id):  JsonResponse
    {
       try{
           $category = $this->categoryRepository->getById($id);

           if (!$category) {
               return response()->json(['message' => 'Categoria não encontrada'], 404);
           }

           return response()->json($category);
       }catch (\Exception $e){
           return response()->json(['message' => 'Erro ao buscar categoria'], 500);
       }

    }

    public function update(CategoryUpdateRequest $request, $id): JsonResponse
    {
        try{
            $data = $request->validated();

            $category = $this->categoryRepository->update($id, $data);

            if (!$category) {
                return response()->json(['message' => 'Categoria não encontrada'], 404);
            }

            return response()->json($category);
        }catch (\Exception $e){
            return response()->json(['message' => 'Erro ao atualizar categoria'], 500);
        }

    }

    public function destroy($id): JsonResponse
    {
       try{
           $category = $this->categoryRepository->delete($id);

           if (!$category) {
               return response()->json(['message' => 'Categoria não encontrada'], 404);
           }

           return response()->json(['message' => 'Categoria removida com sucesso']);
       }catch (\Exception $e){
           return response()->json(['message' => 'Erro ao remover categoria'], 500);
       }

    }

}
