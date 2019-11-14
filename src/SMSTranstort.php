<?php


namespace GsDesign\SMS;


class SMSTranstort
{
    private $params = [];
    private $response = [];

    public function __construct($url, $key, $login = '', $pass = '', $mode = 'http')
    {
        $this->params = compact('url', 'key', 'login', 'pass', 'mode');
    }

    protected function sendHTML($from, $to, $message)
    {

        $params = compact('from', 'to', 'message');
        $params += ['version' => 'http'];
        $params += ($this->params['key'])
            ? ['key' => $this->params['key']]
            : ['login' => $this->params['login'], 'pass' => $this->params['login']];

        $url = $this->httpBuildUrl($this->params['url'], $params);

        $response = @file_get_contents($url);
        $this->httpParseResponse($response);
        return (isset($this->response['id'])) ? $this->response['id'] : false;
    }

    public function __set($name, $value)
    {
        // TODO: Implement __set() method.
        $this->params[$name] = $value;
    }

    public function send($from, $to, $message)
    {
        switch ($this->params['mode'])
        {
            case 'http':
                return $this->sendHTML($from, $to, $message);
                break;
            case 'xml':
                break;
            case 'log':
                break;
            default:
        }
    }

    protected function httpBuildUrl($url, $params)
    {

        if (function_exists('http_build_url'))
        {
            return http_build_url($url, $params);
        }

        return $url . '?' . http_build_query($params);
    }

    protected function httpParseResponse($response)
    {
        $response = explode("\n", $response);
        $data = [];
        foreach ($response as $param)
        {
            if (!$param) continue;
            list($key,$val) = explode(':', $param);
            $data[$key] = $val;
        }
        $this->response = $data;
    }

    public function getResponse()
    {
        return $this->response;
    }
}