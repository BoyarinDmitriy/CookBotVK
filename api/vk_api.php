<?php

define('VK_API_VERSION', '5.50');
define('VK_API_ENDPOINT', 'https://api.vk.com/method/');

function vkApi_messagesSend($peer_id, $message) {
    return _vkApi_call('messages.send', array(
        'peer_id' => $peer_id,
        'message' => $message,
        'access_token' => VK_API_ACCESS_TOKEN,
        'v' => VK_API_VERSION,
    ));
}

function vkApi_usersGet($user_id) {
    return _vkApi_call('users.get', array(
        'user_id' => $user_id,
        'access_token' => VK_API_ACCESS_TOKEN,
        'v' => VK_API_VERSION,
    ));
}

function vkApi_wallGet($domain) {
    return _vkApi_call('wall.get', array(
        'owner_id' => $domain,
        'access_token' => VK_API_ACCESS_TOKEN,
        'v' => VK_API_VERSION,
    ));
}

function _vkApi_call($method, $params = array()) {
    $query = http_build_query($params);
    $url = VK_API_ENDPOINT.$method.'?'.$query;
    print($url);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($json, true);
    print_r($response);
    return $response['response'];
}

