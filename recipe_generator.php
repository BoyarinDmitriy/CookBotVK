<?php

require_once 'vk_api.php';
require_once 'config.php';

function get_recipe($query, $count_of_recipes) {
    $ingredients = explode(', ', $query);
    if(count($ingredients) > 10){
        return'Слишком много ингридиентов!';
    } else {
        $recipe = 'Ничего не удалось найти :(';
    }
    $is_complete_coincidence = true;
    $counter = count($ingredients);
    while($counter > 0){
        $recipes = vkApi_wallSearch(GROUP_DOMAIN, $query);
        $recipes_count = $recipes['count'];
        if ($recipes_count != null) {
            if($recipes_count > 1) {
                if($recipes_count > 19) {
                    $recipes_count = 19;
                }
                if($is_complete_coincidence) {
                    $recipe = '';
                    if($recipes_count > $count_of_recipes){
                        $recipes_count = $count_of_recipes;
                    }
                    for($i = 0; $i < $recipes_count; $i++) {
                        $recipe = $recipe.POST_ADDRESS.$recipes['items'][$i]['id'].PHP_EOL;
                    }

                } else {
                    $recipe = $recipes['items'][rand(0, $recipes_count - 1)]['text'];
                }
                break;
            } else {
                $is_complete_coincidence = false;
                $query = '';
                unset($ingredients[rand(0, count($ingredients) - 1)]);
                foreach($ingredients as $ingredient){
                    $query = $query.$ingredient.'  ';
                }
                $query = str_replace('  ', ', ', trim($query));
                $ingredients = explode(', ', $query);
                $counter--;
            }
        } else {
            $recipe = 'Приходи за новым рецептом завтра!';
            break;
        }
    }
    return $recipe;
}