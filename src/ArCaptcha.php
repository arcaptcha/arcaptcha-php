<?php

namespace Mohammadv184\ArCaptcha;

use GuzzleHttp\Exception\GuzzleException;
use Mohammadv184\ArCaptcha\Adapter\Http;

class ArCaptcha
{
    /**
     * Api Base Uri
     * @var string
     */
    protected $api_base_uri = 'https://api.arcaptcha.ir/arcaptcha/api/';

    /**
     * Script Url
     * @var string
     */
    protected $script_url = 'https://widget.arcaptcha.ir/1/api.js';

    /**
     * User Site Key
     * @var string
     */
    protected $site_key;

    /**
     * User Secret Key
     * @var string
     */
    protected $secret_key;

    /**
     * Widget Color
     * @var string
     */
    protected $color;

    /**
     * Widget Language
     * @var string
     */
    protected $lang;

    /**
     * Widget size (invisible or normal)
     * @var string
     */
    protected $size;

    /**
     * Widget theme
     * @var string
     */
    protected $theme;

    /**
     * Callback function name after challenge is solved
     * @var string
     */
    protected $callback;

    /**
     * Http Adapter
     * @var Http
     */
    protected $http;

    /**
     * ArCaptcha Constructor
     * @param string $site_key
     * @param string $secret_key
     * @param array $options
     */
    public function __construct(string $site_key, string $secret_key, array $options = [])
    {
        $this->site_key = $site_key;
        $this->secret_key = $secret_key;
        $this->color = $options['color'] ?? 'normal';
        $this->lang = $options['lang'] ?? 'fa';
        $this->size = $options['size'] ?? 'normal';
        $this->size = $options['theme'] ?? 'light';
        $this->callback = $options['callback'] ?? '';
    }

    /**
     * Get ArCaptcha Script
     * @return string
     */
    public function getScript(): string
    {
        return sprintf('<script src="%s" async defer></script>', $this->script_url);
    }

    /**
     * Get Arcaptcha Widget
     * @return string
     */
    public function getWidget(array $options = []): string
    {
        return sprintf(
            '<div class="arcaptcha" data-site-key="%s" data-color="%s" data-lang="%s" data-size="%s" data-theme="%s" data-callback="%s"></div>',
            $this->site_key,
            $options['color'] ?? $this->color ?? 'normal',
            $options['lang'] ?? $this->lang ?? 'fa',
            $options['size'] ?? $this->size ?? 'normal',
            $options['theme'] ?? $this->theme ?? 'light',
            $options['callback'] ?? $this->callback ?? '',
        );
    }

    /**
     * Verify Captcha challenge id
     * @param string $challenge_id
     * @return bool
     */
    public function verify(string $challenge_id): bool
    {
        try {
            $response = $this->http->submit('verify', $challenge_id);
        } catch (GuzzleException $e) {
            return false;
        }
        return $response['success'] ?? false;
    }
}
