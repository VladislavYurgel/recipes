<?php

namespace App\Http\Controllers\Api;

use App\Services\Images;
use App\Services\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repository\RecipeStepImagesRepository;
use Repository\RecipeStepsRepository;

class RecipeStepImagesController extends Controller
{
    private $recipeStepImagesRepository;
    private $recipeStepsRepository;

    /**
     * RecipeStepImagesController constructor.
     * @param RecipeStepImagesRepository $recipeStepImagesRepository
     * @param RecipeStepsRepository $recipeStepsRepository
     */
    public function __construct(RecipeStepImagesRepository $recipeStepImagesRepository, RecipeStepsRepository $recipeStepsRepository)
    {
        $this->recipeStepImagesRepository = $recipeStepImagesRepository;
        $this->recipeStepsRepository = $recipeStepsRepository;
    }

    public function addImage(Request $request)
    {
        try {
            $recipeStep = $this->recipeStepsRepository->get(\Route::input('recipe_step'));
            $pathToImage = Images::uploadImage($request->get('image'), true);
            $recipeStepImage = $this->recipeStepImagesRepository->addImage($recipeStep, $pathToImage);
            return Response::success($recipeStepImage);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public function updateImage(Request $request)
    {
        try {
            $recipeStepImage = $this->recipeStepImagesRepository->get(\Route::input('recipe_step_image_id'));
            $pathToImage = Images::uploadImage($request->get('image'), true);
            $recipeStepImage = $this->recipeStepImagesRepository->updateImage($recipeStepImage, $pathToImage);
            return Response::success($recipeStepImage);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public function deleteImage(Request $request)
    {
        try {
            $stepImageId = \Route::input('recipe_step_image_id');
            $this->recipeStepImagesRepository->deleteImage($stepImageId);
            return Response::success(true);
        } catch (\Exception $exception) {
            return Response::error($exception);
        }
    }

    public function changeOrder(Request $request)
    {
        try {
            $recipeStepImages = $this->recipeStepImagesRepository->changeOrder($request);
            return Response::success($recipeStepImages);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }
}
