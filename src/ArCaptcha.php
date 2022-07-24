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
    protected $api_base_uri = 'https://arcaptcha.co/2/';

    /**
     * Script Url
     * @var string
     */
    protected $script_url = 'https://widget.arcaptcha.co/2/api.js';

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
    public function __construct(protected string $site_key, protected string $secret_key, protected array $options = [])
    {
        $this->options['color'] = $options['color'] ?? 'normal';
        $this->options['lang'] = $options['lang'] ?? 'fa';
        $this->options['size'] = $options['size'] ?? 'normal';
        $this->options['theme'] = $options['theme'] ?? 'light';
        $this->options['callback'] = $options['callback'] ?? '';
        $this->http = new Http($this->site_key, $this->secret_key, $this->api_base_uri);

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
            $options['color'] ?? $this->options['color'] ?? 'normal',
            $options['lang'] ?? $this->options['lang']?? 'fa',
            $options['size'] ?? $this->options['size'] ?? 'normal',
            $options['theme'] ?? $this->options['theme'] ?? 'light',
            $options['callback'] ?? $this->options['callback'] ?? '',
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
            $response = $this->http->submit('siteverify', $challenge_id);
        } catch (GuzzleException $e) {
            return false;
        }
        return $response['success'] ?? false;
    }
}
