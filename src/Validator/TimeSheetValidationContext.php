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
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class TimeSheetValidationContext.
 *
 * Used to store timeSheet validation rules
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeSheetValidationContext implements TimeSheetValidationContextInterface
{
    /**
     * @var TimeSheetInterface
     */
    protected $timeSheet;

    /**
     * @var TimeSheetViolation[]
     */
    protected $violations;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var string
     */
    protected $translationDomain;

    /**
     * @param TranslatorInterface  $translator
     * @param string               $translationDomain
     * @param TimeSheetInterface   $timeSheet
     * @param TimeSheetViolation[] $violations
     */
    public function __construct(TranslatorInterface $translator, $translationDomain, TimeSheetInterface $timeSheet, array $violations = [])
    {
        $this->translator = $translator;
        $this->translationDomain = $translationDomain;
        $this->timeSheet = $timeSheet;
        $this->violations = $violations;
    }

    /**
     * {@inheritdoc}
     */
    public function getTimeSheet()
    {
        return $this->timeSheet;
    }

    /**
     * {@inheritdoc}
     */
    public function addViolation($message, array $params = array(), $invalidValue = null, $plural = null, $code = null)
    {
        if (null === $plural) {
            $translatedMessage = $this->translator->trans($message, $params, $this->translationDomain);
        } else {
            try {
                $translatedMessage = $this->translator->transChoice($message, $plural, $params, $this->translationDomain);
            } catch (\InvalidArgumentException $e) {
                $translatedMessage = $this->translator->trans($message, $params, $this->translationDomain);
            }
        }

        $this->violations[] = new TimeSheetViolation(
            $translatedMessage,
            $message,
            $params,
            // check using func_num_args() to allow passing null values
            func_num_args() >= 3 ? $invalidValue : $this->timeSheet,
            $plural,
            $code
        );
    }

    /**
     * {@inheritdoc}
     */
    public function hasViolations()
    {
        return count($this->violations) > 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getViolations()
    {
        return $this->violations;
    }
}
