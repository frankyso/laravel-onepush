<?php

return [
    /*
     |----------------------------------------------------------------------
     | OnePush Configuration
     |----------------------------------------------------------------------
     |
     */
    'env' => 'dev' , // dev || prod
    'onesignal' => [
        'app_id' => ENV('ONESIGNAL_APP_ID',''),
        'rest_api_key' => ENV('ONESIGNAL_REST_API_KEY', ''),
        'user_auth_key'=> ENV('ONESIGNAL_USER_AUTH_KEY','')
    ],

    /**
     * Later it will used for private message
     */
    'user_tag_name' => ENV('ONEPUSH_USER_TAG','agent_id'),
    'interface' => [
        'small_icon_color' => 'FFF12B00',
        'large_icon_url' => ''
    ]
];
