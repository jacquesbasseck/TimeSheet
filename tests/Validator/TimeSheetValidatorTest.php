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
use UCS\Component\TimeSheet\Validator\TimeSheetValidationRuleInterface;
use UCS\Component\TimeSheet\Validator\TimeSheetValidator;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class TimeSheetValidatorTest.
 */
class TimeSheetValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TimeSheetValidator
     */
    private $validator;

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
        $this->validator = new TimeSheetValidator($this->translator, 'messages');
    }

    /**
     * Test that the rule is properly registered and used.
     */
    public function testRule()
    {
        $rule = $this->getMockRule('foo');
        $this->validator->addRule('foo', $rule);

        $this->assertEquals(array('foo' => $rule), $this->validator->getRules(), '->addRule() adds a rule');
        $this->assertEquals($rule, $this->validator->getRule('foo'), '->getRule() returns a rule by name');
        $this->assertNull($this->validator->getRule('bar'), '->getRule() returns null if a rule does not exist');
        $this->assertTrue($this->validator->hasRule('foo'), '->hasRule() returns true if the rule exists');
        $this->assertFalse($this->validator->hasRule('bar'), '->hasRule() returns false if the rule does not exists');
    }

    /**
     * Test that registering two rules with the same name overrides the first one.
     */
    public function testOverriddenRule()
    {
        $this->validator->addRule('foo', $rule1 = $this->getMockRule('foo'));
        $this->validator->addRule('foo', $rule2 = $this->getMockRule('foo'));

        $this->assertEquals($rule2, $this->validator->getRule('foo'));
    }

    /**
     * Test removing a rule.
     */
    public function testRemove()
    {
        $this->validator->addRule('foo', $foo = $this->getMockRule('foo'));
        $this->validator->addRule('bar', $bar = $this->getMockRule('bar'));

        $this->assertEquals($foo, $this->validator->getRule('foo'));
        $this->assertEquals($bar, $this->validator->getRule('bar'));
        $this->assertTrue($this->validator->hasRule('foo'), '->hasRule() returns true if the rule exists');
        $this->assertTrue($this->validator->hasRule('bar'), '->hasRule() returns true if the rule exists');

        $this->validator->removeRule('foo');
        $this->assertSame(array('bar' => $bar), $this->validator->getRules(), '->removeRule() can remove a single rule');
        $this->assertNull($this->validator->getRule('foo'));
    }

    /**
     * Test the validation method.
     */
    public function testValidateTimeSheet()
    {
        $this->validator->addRule('foo', $foo = $this->getMockRule('foo'));
        $this->validator->addRule('bar', $bar = $this->getMockRule('bar'));

        $foo->expects($this->once())
            ->method('validate');

        $bar->expects($this->once())
            ->method('validate');

        $timeSheet = $this->getMock('UCS\Component\TimeSheet\TimeSheetInterface');

        $validationContext = $this->validator->validate($timeSheet);
        $this->assertInstanceOf('UCS\Component\TimeSheet\Validator\TimeSheetValidationContext', $validationContext);
    }

    /**
     * @param string $name
     *
     * @return TimeSheetValidationRuleInterface
     */
    private function getMockRule($name)
    {
        $rule = $this->getMock('UCS\Component\TimeSheet\Validator\TimeSheetValidationRuleInterface');
        $rule->expects($this->any())
            ->method('getName')
            ->will($this->returnValue($name));

        return $rule;
    }
}
