<?php

require_once 'recipe_generator.php';
require_once 'vk_api.php';

function bot_sendMessage($user_id, $message) {
    $recipe = get_recipe($message);
    vkApi_messagesSend($user_id, $recipe);
}
