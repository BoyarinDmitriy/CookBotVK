<?php

define('GROUP_DOMAIN', '-166930934');

function get_recipe($message) {

    $message = vkApi_wallGet(GROUP_DOMAIN);

    return $message['count'];
}
