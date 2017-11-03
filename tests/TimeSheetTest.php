<?php

/*
 * This file is part of the OpenTimeTracker package.
 *
 * Copyright 2015 Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UCS\Component\TimeSheet\Tests;

/* Imports */
use UCS\Component\TimeSheet\TimeSheet;

/**
 * Class TimeSheetTest.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeSheetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the submitted at property is properly handled.
     */
    public function testSubmittedBy()
    {
        $timeSheet = new TimeSheet();

        $this->assertNull($timeSheet->getSubmittedBy(), '->getSubmittedBy() must return null on initialization');

        $value = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');
        $timeSheet->setSubmittedBy($value);
        $this->assertEquals($value, $timeSheet->getSubmittedBy(), '->getSubmittedBy() must return the value set');
    }

    /**
     * Test that the submitted at property is properly handled.
     */
    public function testSubmittedAt()
    {
        $timeSheet = new TimeSheet();

        $this->assertNull($timeSheet->getSubmittedAt(), '->getSubmittedAt() must return null on initialization');

        $value = new \DateTime();
        $timeSheet->setSubmittedAt($value);
        $this->assertEquals($value, $timeSheet->getSubmittedAt(), '->getSubmittedAt() must return the value set');
    }

    /**
     * Test that the submitted at property is properly handled.
     */
    public function tesValidatedBy()
    {
        $timeSheet = new TimeSheet();

        $this->assertNull($timeSheet->getValidatedBy(), '->getValidatedBy() must return null on initialization');

        $value = $this->getMock('Symfony\Component\Security\Core\User\UserInterface');
        $timeSheet->setValidatedBy($value);
        $this->assertEquals($value, $timeSheet->getValidatedBy(), '->getValidatedBy() must return the value set');
    }

    /**
     * Test that the validated at property is properly handled.
     */
    public function testValidatedAt()
    {
        $timeSheet = new TimeSheet();

        $this->assertNull($timeSheet->getValidatedAt(), '->getValidatedAt() must return null on initialization');

        $value = new \DateTime();
        $timeSheet->setValidatedAt($value);
        $this->assertEquals($value, $timeSheet->getValidatedAt(), '->getValidatedAt() must return the value set');
    }

    /**
     * Test that the adding entry works properly.
     */
    public function testAddEntry()
    {
        $timeSheet = new TimeSheet();

        $this->assertCount(0, $timeSheet->getEntries(), '->getEntries() must return an empty entry set on initialization');
        $foo = $this->getMock('UCS\Component\TimeSheet\TimeEntryInterface');

        $timeSheet->addEntry($foo);
        $this->assertCount(1, $timeSheet->getEntries());
        $this->assertEquals([$foo], $timeSheet->getEntries()->toArray(), '->addEntry() must add the entry to the entry set');

        $timeSheet->addEntry($foo);
        $this->assertCount(1, $timeSheet->getEntries());
        $this->assertEquals([$foo], $timeSheet->getEntries()->toArray(), '->addEntry() must keep only one element of the same reference');

        $bar = $this->getMock('UCS\Component\TimeSheet\TimeEntryInterface');
        $timeSheet->addEntry($bar);

        $this->assertCount(2, $timeSheet->getEntries());
        $this->assertEquals([$foo, $bar], $timeSheet->getEntries()->toArray(), '->addEntry() must add the entry to the entry set');
    }

    /**
     * Test that removing a entry works as expected.
     */
    public function testRemoveEntry()
    {
        $timeSheet = new TimeSheet();
        $foo = $this->getMock('UCS\Component\TimeSheet\TimeEntryInterface');
        $bar = $this->getMock('UCS\Component\TimeSheet\TimeEntryInterface');
        $joe = $this->getMock('UCS\Component\TimeSheet\TimeEntryInterface');

        $timeSheet->addEntry($foo);
        $timeSheet->addEntry($bar);

        $timeSheet->removeEntry($joe);
        $this->assertCount(2, $timeSheet->getEntries());
        $this->assertEquals([$foo, $bar], $timeSheet->getEntries()->toArray(), '->removeEntry() must not remove unhandled entries');

        $timeSheet->removeEntry($bar);
        $this->assertCount(1, $timeSheet->getEntries());
        $this->assertEquals([$foo], $timeSheet->getEntries()->toArray(), '->removeEntry() must not remove the requested entry entries');
    }

    /**
     * Test that clearing the whole entry collection is working properly.
     */
    public function testClearEntries()
    {
        $timeSheet = new TimeSheet();
        $foo = $this->getMock('UCS\Component\TimeSheet\TimeEntryInterface');
        $bar = $this->getMock('UCS\Component\TimeSheet\TimeEntryInterface');

        $timeSheet->addEntry($foo);
        $timeSheet->addEntry($bar);

        $this->assertCount(2, $timeSheet->getEntries());
        $timeSheet->clearEntries();

        $this->assertCount(0, $timeSheet->getEntries());
    }
}
