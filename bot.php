<?php

require_once 'recipe_generator.php';
require_once 'vk_api.php';
require_once  'recipe_generator.php';

function bot_sendMessage($user_id, $message) {
    $keyboard = array('one_time' => false,
        'buttons' => array(
            array(
                array(
                    'action' => array(
                        'type' => 'text',
                        'payload' => '{"button": "1"}',
                        'label' => 'Помощь',
                    ),
                    'color' => 'primary'
                ),
                array(
                    'action' => array(
                        'type' => 'text',
                        'payload' => '{"button": "2"}',
                        'label' => 'Случайный рецепт',
                    ),
                    'color' => 'positive'
                )
            )
        )
    );

    $keyboard = json_encode($keyboard,JSON_UNESCAPED_UNICODE);

    switch ($message) {
        case 'Начать':
        case 'Помощь':
            $start_message = 'Привет!'.PHP_EOL.
                'Так-с, давай найдем тебе рецепт'.PHP_EOL.
                'Напиши в строчку через запятую ингредиенты (например: огурец, помидор, лук)';
            vkApi_messagesSend($user_id, $start_message, $keyboard);
            break;
        case 'Случайный рецепт':
            $ingredients = ['огурец', 'помидор', 'морковь', 'лук', 'чкснок', 'молоко', 'мясо', 'масло', 'соль', 'сахар', 'перец'];
            $random_ingredient = $ingredients[array_rand($ingredients)];
            vkApi_messagesSend($user_id, get_recipe($random_ingredient, 1), $keyboard);
            break;
        default:
            $recipe = get_recipe($message);
            vkApi_messagesSend($user_id, $recipe, $keyboard);
            break;
    }
}
