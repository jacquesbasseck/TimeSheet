<?php

/*
 * This file is part of the OpenTimeTracker package.
 *
 * Copyright 2015 Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UCS\Component\TimeSheet\Validator;

/**
 * Represents a time sheet Violation.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeSheetViolation
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $messageTemplate;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var int|null
     */
    private $plural;

    /**
     * @var mixed
     */
    private $invalidValue;

    /**
     * @var mixed
     */
    private $code;

    /**
     * @var mixed
     */
    private $cause;

    /**
     * Creates a new constraint violation.
     *
     * @param string   $message         The violation message
     * @param string   $messageTemplate The raw violation message
     * @param array    $parameters      The parameters to substitute in the
     *                                  raw violation message
     *                                  value to the invalid value
     * @param mixed    $invalidValue    The invalid value that caused this
     *                                  violation
     * @param int|null $plural          The number for determining the plural
     *                                  form when translating the message
     * @param mixed    $code            The error code of the violation
     * @param mixed    $cause           The cause of the violation
     */
    public function __construct($message, $messageTemplate, array $parameters, $invalidValue, $plural = null, $code = null, $cause = null)
    {
        $this->message = $message;
        $this->messageTemplate = $messageTemplate;
        $this->parameters = $parameters;
        $this->plural = $plural;
        $this->invalidValue = $invalidValue;
        $this->code = $code;
        $this->cause = $cause;
    }

    /**
     * Converts the violation into a string for debugging purposes.
     *
     * @return string The violation as string.
     */
    public function __toString()
    {
        $code = $this->code;

        if (!empty($code)) {
            $code = ' (code '.$code.')';
        }

        return $this->getMessage().$code;
    }

    /**
     * @return string
     */
    public function getMessageTemplate()
    {
        return $this->messageTemplate;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getPlural()
    {
        return $this->plural;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getInvalidValue()
    {
        return $this->invalidValue;
    }

    /**
     * Returns the cause of the violation.
     *
     * @return mixed
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }
}
