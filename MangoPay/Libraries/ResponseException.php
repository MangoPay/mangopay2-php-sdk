<?php

namespace MangoPay\Libraries;

/**
 * Response exception class
 */
class ResponseException extends Exception
{
    /**
     * Array with response code and corresponding response message
     * @var array
     */
    private $_responseCodes = [
        200 => 'OK',
        204 => 'No Content',
        206 => 'PartialContent',
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Prohibition to use the method',
        404 => 'Not found',
        405 => 'Method not allowed',
        413 => 'Request entity too large',
        422 => 'Unprocessable entity',
        500 => 'Internal server error',
        501 => 'Not implemented'
    ];

    /**
     * Error details
     * @var Error|null
     */
    private $_errorInfo;

    /**
     * Error code
     * @var int
     */
    private $_code;

    /**
     * Request URL
     * @var string
     */
    public $RequestUrl;

    /**
     * Construct
     * @param int $code Response code
     * @param Error|null $errorInfo Details with the error
     */
    public function __construct($requestUrl, $code, $errorInfo = null)
    {
        $this->RequestUrl = $requestUrl;
        $this->_code = $code;

        if (isset($this->_responseCodes[$code])) {
            $errorMsg = $this->_responseCodes[$code];
        } else {
            $errorMsg = 'Unknown response error';
        }

        if (!is_null($errorInfo)) {
            $errorMsg .= '. ' . $errorInfo->Message;
            $this->_errorInfo = $errorInfo;
        }

        parent::__construct($errorMsg, $code);
    }

    /**
     * Get Error object returned by REST API
     * @return Error|null
     */
    public function GetErrorDetails()
    {
        return $this->_errorInfo;
    }

    /**
     * Get Error code returned by REST API
     * @return int
     */
    public function GetErrorCode()
    {
        return $this->_code;
    }
}
