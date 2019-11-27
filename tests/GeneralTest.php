<?php

namespace frankyso\OnePush\Tests;

use frankyso\OnePush\OnePush;

class GeneralTest extends \Orchestra\Testbench\TestCase
{
    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('onepush', [
            'env'=>'dev',
            'onesignal' => [
                'app_id' => ENV('ONESIGNAL_APP_ID'),
                'rest_api_key' => ENV('ONESIGNAL_REST_API_KEY'),
                'user_auth_key' => ENV('ONESIGNAL_USER_AUTH_KEY')
            ],

            /**
             * Later it will used for private message
             */
            'user_tag_name' => ENV('ONEPUSH_USER_TAG', 'agent_id'),
            'interface' => [
                'small_icon_color' => 'FFF12B00',
                'large_icon_url' => 'https://cdn.techinasia.com/data/images/nIIEA4goPxolbgc32HLF5PeFMr2pcLsZKtOKH8sV.png'
            ]
        ]);
    }

    public function testSendBroadcastMessage()
    {
        $onepush = new OnePush();
        $onepush->broadcastNotification("Normal Notification", "Notifikasi Normal")->send();
    }

    public function testSendBoradcastMessageWithBanner()
    {
        $onepush = new OnePush();
        $onepush->broadcastNotification("Test Banner", "Banner")->setBanner('https://miro.medium.com/max/2560/1*tqc2Tf1dK9WFJi2YW2rh9Q.png')->send();
    }

    public function testSendBroadcastWithRedirect(){
        $onepush = new OnePush();
        $onepush->broadcastNotification("Notification With Redirect", "Notification Redirect")->setRedirectUrl('https://woobiz.id/')->send();
    }

    public function testPrivateNotification(){
        $onepush = new OnePush();
        $onepush->privateNotification(126,"Private Notification", "Notifikasi Private")->send();
    }

    public function testSendPrivateMessageWithBanner(){
        $onepush = new OnePush();
        $onepush->privateNotification(126,"Test Banner", "Banner")->setBanner('https://miro.medium.com/max/2560/1*tqc2Tf1dK9WFJi2YW2rh9Q.png')->send();
    }

    public function testSendPrivateMessageWithRedirect(){
        $onepush = new OnePush();
        $onepush->privateNotification(126,"Notification With Redirect", "Notification Redirect")->setRedirectUrl('https://woobiz.id/')->send();
    }
}
