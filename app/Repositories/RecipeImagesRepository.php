<?php

namespace Repository;

use App\Models\RecipeImages;
use App\Models\Recipes;
use App\Services\Images;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class RecipeImagesRepository
{
    const MAX_PHOTOS_PER_RECIPE = 5;

    /**
     * Add image to the recipe
     *
     * @param $recipeId
     * @param $pathToImage
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     * @internal param Request $request
     */
    public function addImageToRecipe($recipeId, $pathToImage)
    {
        $recipe = (new RecipeRepository())->get($recipeId);
        if ($recipe->images()->count() >= self::MAX_PHOTOS_PER_RECIPE) {
            throw new \Exception("Max photos per recipe is " . self::MAX_PHOTOS_PER_RECIPE);
        }
        $preparedData = [
            'image_index' => $recipe->images()->count(),
            'path' => $pathToImage
        ];
        $image = $recipe->images()->create($preparedData);

        return $image;
    }

    /**
     * Update recipe image
     *
     * @param $recipeId
     * @param $imageId
     * @param $pathToImage
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @throws \Exception
     * @internal param Request $request
     */
    public function updateImage($recipeId, $imageId, $pathToImage, Request $request)
    {
        $recipe = (new RecipeRepository())->get($recipeId);
        $image = $recipe->images()->find($imageId);
        if (!$image) {
            throw new \Exception("Image with id {$imageId} not found");
        }
        $image->update(['path' => $pathToImage]);

        return $image;
    }

    /**
     * Delete the recipe image by recipe image id
     *
     * @param $recipeImageId
     * @return bool
     * @throws \Exception
     */
    public function deleteImage($recipeImageId) {
        if (RecipeImages::find($recipeImageId)->delete()) {
            return true;
        }
        throw new \Exception("Recipe image with id {$recipeImageId} not found or already deleted");
    }

    /**
     * Update order recipe images
     *
     * @param Request $request
     * @return mixed
     */
    public function changeOrder(Request $request)
    {
        $images = json_decode($request->get('images'));
        $resultImages = [];
        foreach ($images as $item) {
            $resultImages[] = $this->get($item->id)->update(['image_index' => $item->index]);
        }
        return $resultImages;
    }

    /**
     * Get recipe image by id
     *
     * @param $recipeImageId
     * @return RecipeImages
     * @throws \Exception
     */
    public function get($recipeImageId)
    {
        $image = RecipeImages::find($recipeImageId);
        if (!$image) {
            throw new \Exception("Image with id {$recipeImageId} not found");
        }
        return $image;
    }

    /**
     * Prepare data before insert or update image
     *
     * @param array $data
     * @return array
     */
    public function prepareData(array $data)
    {
        return $data;
    }
}