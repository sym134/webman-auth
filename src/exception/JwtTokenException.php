<?php

namespace WebmanAuth\exception;


class JwtTokenException extends \RuntimeException
{
    protected $error;

    public function __construct($error,$code = 401)
    {
        parent::__construct();
        $this->error = $error;
        $this->code = $code;
        $this->message = is_array($error) ? implode(PHP_EOL, $error) : $error;
    }

    /**
     * @param mixed $code
     * @return JwtTokenException
     */
    public function setCode($code): JwtTokenException
    {
        $this->code = $code;
        return $this;
    }

    /**
     * 获取验证错误信息
     * @access public
     * @return array|string
     */
    public function getError()
    {
        return $this->error;
    }
}
