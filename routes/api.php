<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'recipe'], function() {
    Route::post('create', 'Api\RecipeController@create');

    Route::get('all', 'Api\RecipeController@all');
    Route::get('{recipe_id}', 'Api\RecipeController@get');

    Route::post('{recipe_id}/ingredients/add', 'Api\RecipeIngredientsController@addIngredient');
    Route::post('{recipe_id}/ingredients/{recipe_ingredient_id}/update', 'Api\RecipeIngredientsController@updateIngredient');
    Route::post('{recipe_id}/ingredients/{recipe_ingredient_id}/delete', 'Api\RecipeIngredientsController@deleteIngredient');

    Route::post('{recipe_id}/images/addImage', 'Api\RecipeImagesController@addImage');
    Route::post('{recipe_id}/images/updateImage', 'Api\RecipeImagesController@updateImage');
    Route::post('/images/{recipe_image_id}/deleteImage', 'Api\RecipeImagesController@deleteImage');

    Route::post('{recipe_id}/step/add', 'Api\RecipeStepsController@create');
    Route::post('/step/{recipe_step}/update', 'Api\RecipeStepsController@update');
    Route::post('/step/{recipe_step}/addImage', 'Api\RecipeStepImagesController@addImage');
    Route::post('/step/{recipe_step_image_id}/updateImage', 'Api\RecipeStepImagesController@updateImage');
    Route::post('/step/{recipe_step_image_id}/deleteImage', 'Api\RecipeStepImagesController@deleteImage');
    Route::post('/step/images/changeOrder', 'Api\RecipeStepImagesController@changeOrder');

    Route::post('changeOrder', 'Api\RecipeImagesController@changeOrder');
});