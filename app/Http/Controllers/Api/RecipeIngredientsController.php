<?php

namespace App\Http\Controllers\Api;

use App\Services\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repository\RecipeIngredientsRepository;
use Repository\RecipeRepository;

class RecipeIngredientsController extends Controller
{
    private $recipeIngredientsRepository;
    private $recipesRepository;

    /**
     * RecipeIngredientsController constructor.
     * @param RecipeIngredientsRepository $recipeIngredientsRepository
     * @param RecipeRepository $recipeRepository
     */
    public function __construct(RecipeIngredientsRepository $recipeIngredientsRepository, RecipeRepository $recipeRepository)
    {
        $this->recipeIngredientsRepository = $recipeIngredientsRepository;
        $this->recipesRepository = $recipeRepository;
    }

    public function addIngredient(Request $request)
    {
        try {
            $recipe = $this->recipesRepository->get(\Route::input('recipe_id'));
            $ingredient = $this->recipeIngredientsRepository->addIngredient($recipe, $request);
            return Response::success($ingredient);
        } catch (\Exception $exception) {
            return Response::error($exception);
        }
    }

    public function updateIngredient(Request $request)
    {
        try {
            $ingredient = $this->recipeIngredientsRepository->get(\Route::input('recipe_ingredient_id'));
            $ingredient = $this->recipeIngredientsRepository->updateIngredient($ingredient, $request);
            return Response::success($ingredient);
        } catch (\Exception $exception) {
            return Response::error($exception);
        }
    }

    public function deleteIngredient(Request $request)
    {
        try {

        } catch (\Exception $exception) {
            return Response::error($exception);
        }
    }
}
