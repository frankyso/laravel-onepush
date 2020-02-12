<?php

namespace frankyso\OnePush;

use Berkayk\OneSignal\OneSignalClient;

class OnePush
{
    protected $builder;
    public $env = 'dev';

    public function __construct()
    {
        $this->builder = new MessageBuilder($this);
    }

    public function env($env = 'dev')
    {
        $this->env = $env;
    }

    /**
     * Broadcast Notification
     *
     * @param null $message
     * @param null $headings
     * @param null $largeIcon
     * @return MessageBuilder
     */
    public function broadcastNotification($message = null, $headings = null, $largeIcon = null)
    {
        $this->builder->setMessage($message);
        $this->builder->setHeadings($headings);
        $this->builder->setLargeIcon($largeIcon);

        return $this->builder;
    }


    /**
     * Broadcast Notification with redirect Url
     *
     * @return void
     */
    public function broadcastRedirect($url)
    {
        return $this->builder->setRedirectUrl($url);
    }

    /**
     * Send Private Notification
     *
     * @param [type] $id
     * @return MessageBuilder
     */
    public function privateNotification($id, $message = null, $headings = null, $largeIcon = null)
    {
        $this->builder->setMessage($message);
        $this->builder->setHeadings($headings);
        $this->builder->setLargeIcon($largeIcon);
        $this->builder->setTags(["key" => config('onepush.user_tag_name'), "relation" => "=", "value" => $id]);

        return $this->builder;

        // $this->tags[] = ["key"=>config('onepush'), "relation"=>"=", "value"=>""];
    }

    /**
     * Private Notification with Redirect Notification
     */

    public function privateRedirect()
    {
        // $this->tags[] = ["key"=>config('onepush'), "relation"=>"=", "value"=>""];
    }
}

class MessageBuilder
{
    protected $oneSignal;
    protected $onePush;
    protected $tags = [];
    protected $isPrivate = false;

    protected $interface = [
        'banner' => null,
        'message' => null,
        'headings' => null,
        'large_icon' => null,
        'small_icon_color' => null,
        'redirect' => null,
    ];

    public function __construct($onePush)
    {
        $this->onePush = $onePush;
        $this->oneSignal = new OneSignalClient(config('onepush.onesignal.app_id'), config('onepush.onesignal.rest_api_key'), config('onepush.onesignal.user_auth_key'));
        $this->setIconColor(config('onepush.interface.small_icon_color'));
        $this->setTags(["key" => 'env', "relation" => "=", "value" => config('onepush.env')]);
    }

    public function setMessage($message)
    {
        $this->interface['message'] = $message;
    }

    /**
     * Set Heading
     *
     * @return void
     */
    public function setHeadings($string)
    {
        $this->interface['headings'] = $string;
    }

    public function setLargeIcon($url = null)
    {
        $this->interface['large_icon'] = $url ?? config('onepush.interface.large_icon_url');
    }

    public function setIconColor($hex)
    {
        $this->interface['small_icon_color'] = $hex ?? config('onepush.interface.small_icon_color');
    }

    public function setBanner($url = null)
    {
        $this->interface['banner'] = $url;
        return $this;
    }

    public function setRedirectUrl($urlRedirect = null)
    {
        $this->interface['redirect'] = $urlRedirect;
        return $this;
    }

    public function setTags($tags = [])
    {
        $this->tags[] = $tags + ["field"=> "tag"];
//        var_dump($this->tags);
//        exit;
        return $this;
    }

    /**
     * Trigger Send Button
     *
     * @return GuzzleHttp\Psr7\Response
     */
    public function send()
    {
        $parameters = [
            'headings' => [
                'en' => $this->interface['headings'],
            ],
            'contents' => [
                'en' => $this->interface['message'],
            ],
            'big_picture' => $this->interface['banner'],
            'ios_attachments' => [
                "id" => "https://solvus.com.br/wp-content/uploads/2016/05/Push-Notification-01-2.png"
            ],
            'ios_badgeType' => 'Increase',
            'ios_badgeCount' => 1,
            'included_segments' => ['All'],
            'filters' => $this->tags,
            'large_icon' => $this->interface['large_icon']
        ];

        if ($this->interface['redirect'] != null) {
            $parameters['url'] = $this->interface['redirect'];
        }

        return $this->oneSignal->sendNotificationCustom($parameters);
    }
}
