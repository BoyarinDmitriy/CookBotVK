<?php

function get_recipe($query) {
    $ingredients = explode(', ', $query);
    if(count($ingredients) > 10){
        return'Слишком много ингридиентов!';
    } else {
        $recipe = 'Ничего не удалось найти :(';
    }
    $is_complete_coincidence = true;
    do {
        $recipes = vkApi_wallSearch(GROUP_DOMAIN, $query);
        $recipes_count = $recipes['count'];
        if($recipes_count > 1) {
            if($recipes_count > 19) {
                $recipes_count = 19;
            }
            if($is_complete_coincidence) {
                $recipe = POST_ADDRESS.$recipes['items'][rand(0, $recipes_count - 1)]['id'];
            } else {
                $recipe = $recipes['items'][rand(0, $recipes_count - 1)]['text'];
            }
            break;
        } else {
            $is_complete_coincidence = false;
            $query = '';
            unset($ingredients[rand(0, count($ingredients) - 1)]);
            foreach($ingredients as $ingredient){
                $query = $query.$ingredient.' ';
            }
            $query = str_replace(' ', ', ', trim($query));
            $ingredients = explode(', ', $query);
        }
    } while(count($ingredients) > 0);
    return $recipe;
}