<?php

require_once 'recipe_generator.php';
require_once 'vk_api.php';

function bot_sendMessage($user_id, $message) {
    switch ($message) {
        case 'Начать':
            $start_message = 'Привет!'.PHP_EOL.
                'Так-с, давай найдем тебе рецепт'.PHP_EOL.
                'Напиши в строчку через запятую ингредиенты (например: огурец, помидор, лук)';
            vkApi_messagesSend($user_id, $start_message);
            break;
        default:
            $recipe = get_recipe($message);
            vkApi_messagesSend($user_id, $recipe);
            break;
    }
}
