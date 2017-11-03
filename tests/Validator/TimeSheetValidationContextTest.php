<?php

/*
 * This file is part of the OpenTimeTracker package.
 *
 * Copyright 2015 Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UCS\Component\TimeSheet\Tests\Validator;

/* Imports */
use UCS\Component\TimeSheet\Validator\TimeSheetValidationContext;

/**
 * Class TimeSheetValidationContextTest.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeSheetValidationContextTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * {@inheritdoc}
     */
    public function setup()
    {
        $this->translator = $this->getMock('Symfony\Component\Translation\TranslatorInterface');
        $this->translator->expects($this->any())
            ->method('trans')
            ->will($this->returnArgument(0));
    }

    /**
     * Test the add violation method.
     */
    public function testViolations()
    {
        $context = $this->getValidationContext();
        $this->assertFalse($context->hasViolations(), '->hasViolations returns false when no violations');

        $context->addViolation('Invalid TimeSheet', [], $context->getTimeSheet(), null, 123);

        $this->assertCount(1, $context->getViolations(), '->addViolation should add a new violation');
        $this->assertTrue($context->hasViolations(), '->hasViolations returns true when violations added');

        $violations = $context->getViolations();
        $violation = $violations[0];

        $this->assertEquals('Invalid TimeSheet', $violation->getMessage());
        $this->assertEquals($context->getTimeSheet(), $violation->getInvalidValue());
        $this->assertEquals('Invalid TimeSheet (code 123)', $violation->__toString());
    }

    /**
     * @return TimeSheetValidationContext
     */
    private function getValidationContext()
    {
        $timeSheet = $this->getMock('UCS\Component\TimeSheet\TimeSheetInterface');

        return new TimeSheetValidationContext($this->translator, 'messages', $timeSheet);
    }
}
