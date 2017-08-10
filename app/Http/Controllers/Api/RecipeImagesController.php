<?php

namespace App\Http\Controllers\Api;

use App\Services\Images;
use App\Services\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repository\RecipeImagesRepository;

class RecipeImagesController extends Controller
{
    private $recipeImagesRepository;

    /**
     * RecipeImagesController constructor.
     * @param RecipeImagesRepository $recipeImagesRepository
     */
    public function __construct(RecipeImagesRepository $recipeImagesRepository)
    {
        $this->recipeImagesRepository = $recipeImagesRepository;
    }

    public function addImage(Request $request)
    {
        try {
            $pathToImage = Images::uploadImage($request->get('image'), true);
            $image = $this->recipeImagesRepository->addImageToRecipe(\Route::input('recipe_id'), $pathToImage);
            return Response::success($image);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public function updateImage(Request $request)
    {
        try {
            $pathToImage = Images::uploadImage($request->get('image'), true);
            $image = $this->recipeImagesRepository->updateImage(\Route::input('recipe_id'), $request->get('image_id'), $pathToImage, $request);
            return Response::success($image);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public function deleteImage(Request $request)
    {
        try {
            $recipeImageId = \Route::input('recipe_image_id');
            $this->recipeImagesRepository->deleteImage($recipeImageId);
            return Response::success("Image was deleted");
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }

    public function changeOrder(Request $request)
    {
        try {
            $result = $this->recipeImagesRepository->changeOrder($request);
            return Response::success($result);
        } catch (\Exception $exception) {
            return Response::error($exception->getMessage());
        }
    }
}
