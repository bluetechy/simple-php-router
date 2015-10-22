<?php
namespace Pecee\Http;

class Request {

    protected $uri;
    protected $host;
    protected $method;
    protected $headers;

    public function __construct() {
        $this->host = $_SERVER['HTTP_HOST'];
        $this->uri = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $this->method = (isset($_POST['_method'])) ? strtolower($_POST['_method']) : strtolower($_SERVER['REQUEST_METHOD']);
        $this->headers = getallheaders();
    }

    /**
     * @return string
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getHost() {
        return $this->host;
    }

    /**
     * @return string
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * Get http basic auth user
     * @return string|null
     */
    public function getUser() {
        return (isset($_SERVER['PHP_AUTH_USER'])) ? $_SERVER['PHP_AUTH_USER']: null;
    }

    /**
     * Get http basic auth password
     * @return string|null
     */
    public function getPassword() {
        return (isset($_SERVER['PHP_AUTH_PW'])) ? $_SERVER['PHP_AUTH_PW']: null;
    }

    /**
     * Get headers
     * @return array
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Get id address
     * @return string
     */
    public function getIp() {
        return isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Get referer
     * @return string
     */
    public function getReferer() {
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
    }

    /**
     * Get user agent
     * @return string
     */
    public function getUserAgent() {
        return isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    }

    /**
     * Get header value by name
     * @param string $name
     * @return string|null
     */
    public function getHeader($name) {
        return (isset($this->headers[$name])) ? $this->headers[$name] : null;
    }

    /**
     * Get request input or default value
     * @param string $name
     * @param string $defaultValue
     * @return mixed
     */
    public function getInput($name, $defaultValue) {
        return (isset($_REQUEST[$name]) ? $_REQUEST[$name] : $defaultValue);
    }

}