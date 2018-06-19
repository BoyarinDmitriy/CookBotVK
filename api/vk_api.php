<?php

define('VK_API_ENDPOINT', 'https://api.vk.com/method/');
define('VK_API_VERSION', '5.50');
define('VK_API_SERVICE_TOKEN', 'd9c02b26d9c02b26d9c02b26fdd9a4f3f9dd9c0d9c02b2682e7c02f21adc58266ea11c7');
define('GROUP_DOMAIN', 'sekretwomen');
define('POST_ADDRESS','https://vk.com/sekretwomen?w=wall-49724592_');
define('VK_API_ACCESS_TOKEN', '297aa82a72a59f70e54c9efc578764475cca3c8702ff16ba0464a6b76c89716abd4fbeba551d4668f2a43');


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

function vkApi_wallSearch($domain, $query) {
    return _vkApi_call('wall.search', array(
        'domain' => $domain,
        'query' => $query,
        'access_token' => VK_API_SERVICE_TOKEN,
        'v' => VK_API_VERSION,
    ));
}

function _vkApi_call($method, $params = array()) {
    $query = http_build_query($params);
    $url = VK_API_ENDPOINT.$method.'?'.$query;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($json, true);
    return $response['response'];
}

