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
use UCS\Component\TimeSheet\TimeSheetInterface;

/**
 * Interface TimeSheetValidatorInterface.
 *
 * Specification for the time sheet validator.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
interface TimeSheetValidatorInterface
{
    /**
     * @param TimeSheetInterface $timeSheet
     *
     * @return TimeSheetValidationContextInterface
     */
    public function validate(TimeSheetInterface $timeSheet);
}
