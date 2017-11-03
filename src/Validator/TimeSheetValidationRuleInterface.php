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
 * Interface TimeSheetValidationRuleInterface.
 *
 * Implement this class to add a password validation rule
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
interface TimeSheetValidationRuleInterface
{
    /**
     * Returns a unique name for your password rule.
     *
     * @return string
     */
    public function getName();

    /**
     * Validate the current password accordingly to specific rules the password is accessible within the context.
     *
     * @param TimeSheetValidationContext $validationContext
     *
     * @return bool
     */
    public function validate(TimeSheetValidationContext $validationContext);
}
