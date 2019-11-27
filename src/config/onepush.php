<?php

return [
    /*
     |----------------------------------------------------------------------
     | OnePush Configuration
     |----------------------------------------------------------------------
     |
     */
    'onesignal' => [
        'app_id' => ENV('ONESIGNAL_APP_ID',''),
        'rest_api_key' => ENV('ONESIGNAL_REST_API_KEY', '')
    ],

    /**
     * Later it will used for private message
     */
    'user_tag_name' => ENV('ONEPUSH_USER_TAG'),
    'interface' => [
        'small_icon_color' => ''
    ]
];
