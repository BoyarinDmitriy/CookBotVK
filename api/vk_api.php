<?php

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

