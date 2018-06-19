<?php

require_once 'recipe_generator.php';

function bot_sendMessage($user_id, $message) {
    $recipe = get_recipe($message);
    vkApi_messagesSend($user_id, $recipe);
}
