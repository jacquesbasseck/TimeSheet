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
 * Class TimeSheetValidator.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeSheetValidator implements TimeSheetValidatorInterface
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var string
     */
    private $translationDomain;

    /**
     * @var TimeSheetValidationRuleInterface[]
     */
    private $rules;

    /**
     * Constructor.
     *
     * @param TranslatorInterface $translator
     * @param string              $translationDomain
     * @param array               $rules
     */
    public function __construct(TranslatorInterface $translator, $translationDomain, array $rules = [])
    {
        $this->translator = $translator;
        $this->translationDomain = $translationDomain;
        $this->rules = $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(TimeSheetInterface $timeSheet)
    {
        $validationContext = new TimeSheetValidationContext($this->translator, $this->translationDomain, $timeSheet);

        foreach ($this->rules as $rule) {
            $rule->validate($validationContext);
        }

        return $validationContext;
    }

    /**
     * @return TimeSheetValidationRuleInterface[]
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * @param string                           $name
     * @param TimeSheetValidationRuleInterface $rule
     *
     * @return $this
     */
    public function addRule($name, TimeSheetValidationRuleInterface $rule)
    {
        unset($this->rules[$name]);
        $this->rules[$name] = $rule;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function removeRule($name)
    {
        unset($this->rules[$name]);

        return $this;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasRule($name)
    {
        return isset($this->rules[$name]);
    }

    /**
     * @param string $name
     *
     * @return null|TimeSheetValidationRuleInterface
     */
    public function getRule($name)
    {
        return isset($this->rules[$name]) ? $this->rules[$name] : null;
    }
}
