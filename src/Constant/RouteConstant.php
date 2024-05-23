<?php

namespace ChangYuJunGe\Message\Constant;

class RouteConstant
{
    public const MESSAGE_TYPE_DINGTALK = 'dingtalk';
    public const MESSAGE_TYPE_SMS = 'sms';
    public const MESSAGE_TYPE_EMAIL = 'email';
    public const MESSAGE_TYPE_APP = 'app';
    public const MESSAGE_TYPE_FEISHU = 'feishu';
    public const MESSAGE_TYPE_WECHAT = 'wechat';
    public const MESSAGE_TYPE_SITE = 'site';

    /**
     * 钉钉消息路由
     * @var string
     */
    public const DINGTALK_SEND_MESSAGE_ROUTE = '/message/dingtalk/v1/sendMessage';
    public const SMS_SEND_MESSAGE_ROUTE = '';
    public const EMAIL_SEND_MESSAGE_ROUTE = '';
    public const APP_SEND_MESSAGE_ROUTE = '';
    public const FEISHU_SEND_MESSAGE_ROUTE = '';
    public const WECHAT_SEND_MESSAGE_ROUTE = '';
    public const SITE_SEND_MESSAGE_ROUTE = '';

    public const SEND_MESSAGE_ROUTE_MAP = [
        self::MESSAGE_TYPE_DINGTALK => self::DINGTALK_SEND_MESSAGE_ROUTE,
        self::MESSAGE_TYPE_SMS => self::SMS_SEND_MESSAGE_ROUTE,
        self::MESSAGE_TYPE_EMAIL => self::EMAIL_SEND_MESSAGE_ROUTE,
        self::MESSAGE_TYPE_APP => self::APP_SEND_MESSAGE_ROUTE,
        self::MESSAGE_TYPE_FEISHU => self::FEISHU_SEND_MESSAGE_ROUTE,
        self::MESSAGE_TYPE_WECHAT => self::WECHAT_SEND_MESSAGE_ROUTE,
        self::MESSAGE_TYPE_SITE => self::SITE_SEND_MESSAGE_ROUTE,
    ];
}

const DINGTALK_SEND_MESSAGE_URL = '172.16.1.2:8001/message/dingtalk/v1/sendMessage';