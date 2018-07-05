<?php

require_once 'config.php';
require_once 'bot.php';

if (!isset($_REQUEST)) {
    exit;
}

callback_handleEvent();

function callback_handleEvent() {
    $event = _callback_getEvent();
    switch ($event['type']) {
        case CALLBACK_API_EVENT_CONFIRMATION:
            _callback_handleConfirmation();
            break;
        case CALLBACK_API_EVENT_MESSAGE_NEW:
            _callback_handleMessageNew($event['object']);
            break;
        case CALLBACK_API_EVENT_GROUP_JOIN:
            _callback_handleGroupJoin($event['object']);
            break;
        default:
            _callback_response('Unsupported event');
            break;
    }
    _callback_okResponse();
}

function _callback_getEvent() {
    return json_decode(file_get_contents('php://input'), true);
}

function _callback_handleConfirmation() {
    _callback_response(CALLBACK_API_CONFIRMATION_TOKEN);
}

function _callback_handleMessageNew($data) {
    $user_id = $data['user_id'];
    $message = $data['body'];
    bot_sendRecipe($user_id, $message);
    _callback_okResponse();
}

function _callback_handleGroupJoin($data) {
    $user_id = $data['user_id'];
    $user_info = bot_usersGet($user_id);
    $user_name = $user_info[0]['first_name'];
    bot_sendWelcomeMessage($user_id, $user_name);
    _callback_okResponse();
}

function _callback_okResponse() {
    _callback_response('ok');
}

function _callback_response($data) {
    echo $data;
    exit();
}


