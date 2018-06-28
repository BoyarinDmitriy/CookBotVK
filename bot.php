<?php

require_once 'recipe_generator.php';
require_once 'vk_api.php';

function bot_sendMessage($user_id, $message) {
    $keyboard = array('one_time' => false,
        'buttons' => array(
            array(
                array(
                    'action' => array(
                        'type' => 'text',
                        'payload' => '{"button": "1"}',
                        'label' => "Help",
                    ),
                    'color' => 'primary')
        )));

    $keyboard = json_encode($keyboard);

    switch ($message) {
        case 'Начать':
            $start_message = 'Привет!'.PHP_EOL.
                'Так-с, давай найдем тебе рецепт'.PHP_EOL.
                'Напиши в строчку через запятую ингредиенты (например: огурец, помидор, лук)';
            vkApi_messagesSend($user_id, $start_message, $keyboard);
            break;
        default:
            $recipe = get_recipe($message);
            vkApi_messagesSend($user_id, $recipe, $keyboard);
            break;
    }
}
