<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omnipay\Ideal\Message;

/**
 * iDeal Response
 */
abstract class AbstractResponse extends \Omnipay\Common\Message\AbstractResponse
{

    public function isSuccessful()
    {
        return !isset($this->data->Error) && isset($this->data->Acquirer) && $this->rootElementExists();
    }

    public abstract function rootElementExists();

    public function getAcquirerID()
    {
        if (isset($this->data->Acquirer)) {
            return (string)$this->data->Acquirer->acquirerID;
        }
    }

    public function getData() {
        return $this->data;
    }

    public function getError() {
        return $this->data->Error;
    }

    /**
     * Get error code
     *
     * @return string
     */
    public function getCode()
    {
        if (isset($this->data->Error)) {
            return (string)$this->data->Error->errorCode;
        }
    }

    /**
     * @deprecated To make the code more consistence with other Omnipay packages use getCode()
     * @return string
     */
    public function getErrorCode()
    {
        return $this->getCode();
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function getMessage()
    {
        if (isset($this->data->Error)) {
            return (string)$this->data->Error->errorDetail . ' - ' . (string)$this->data->Error->errorMessage;
        }
    }

    /**
     * @deprecated To make the code more consistence with other Omnipay packages use getMessage()
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->getMessage();
    }

    public function getErrorDetail() {
        if (isset($this->data->Error)) {
            return (string)$this->data->Error->errorDetail;
        }
    }

    public function getConsumerMessage() {
        if (isset($this->data->Error)) {
            return (string)$this->data->Error->consumerMessage;
        }
    }
}
