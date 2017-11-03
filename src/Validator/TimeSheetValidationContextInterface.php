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

/* Imports */

/**
 * Specification for a TimeSheetValidationContext you may want to implement this class if you
 * want to write your own TimeSheetValidator.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
interface TimeSheetValidationContextInterface
{
    /**
     * @return string
     */
    public function getTimeSheet();

    /**
     * Add a violation message for the password currently checked.
     *
     * @param string $message
     * @param array  $params
     * @param string $invalidValue
     * @param string $plural
     * @param mixed  $code
     */
    public function addViolation($message, array $params = [], $invalidValue = null, $plural = null, $code = null);

    /**
     * Check if the context has validation violations.
     *
     * @return bool
     */
    public function hasViolations();

    /**
     * @return TimeSheetViolation[]
     */
    public function getViolations();
}
