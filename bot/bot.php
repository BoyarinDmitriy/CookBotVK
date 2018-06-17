<?php

require_once 'recipe_generator.php';

function bot_sendMessage($user_id, $message) {

    $msg = get_recipe($message);

    vkApi_messagesSend($user_id, $msg);
}
