<?php

namespace App\Http\Controllers\Api;

use App\Services\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repository\RecipeRepository;
use Repository\RecipeStepsRepository;

class RecipeStepsController extends Controller
{
    private $recipeStepsRepository;
    private $recipeRepository;

    public function __construct(RecipeStepsRepository $recipeStepsRepository, RecipeRepository $recipeRepository)
    {
        $this->recipeStepsRepository = $recipeStepsRepository;
        $this->recipeRepository = $recipeRepository;
    }

    public function create(Request $request)
    {
        try {
            $recipe = $this->recipeRepository->get(\Route::input('recipe_id'));
            $recipeStep = $this->recipeStepsRepository->create($recipe, $request);
            return Response::success($recipeStep);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            $recipeStep = $this->recipeStepsRepository->get(\Route::input('recipe_step'));
            $recipeStep = $this->recipeStepsRepository->update($recipeStep, $request);
            return Response::success($recipeStep);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }
}
