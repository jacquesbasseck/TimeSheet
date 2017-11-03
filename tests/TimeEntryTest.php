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
use UCS\Component\TimeSheet\TimeEntry;

/**
 * Class TimeEntryTest.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeEntryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test that the description property is properly handled.
     */
    public function testTimeSheet()
    {
        $timeEntry = new TimeEntry();

        $this->assertNull($timeEntry->getTimeSheet(), '->getTimeSheet() must return null on initialization');

        $value = $this->getMock('UCS\Component\TimeSheet\TimeSheet');
        $timeEntry->setTimeSheet($value);
        $this->assertEquals($value, $timeEntry->getTimeSheet(), '->getTimeSheet() must return the value set');
    }

    /**
     * Test that the description property is properly handled.
     */
    public function testDescription()
    {
        $timeEntry = new TimeEntry();

        $this->assertNull($timeEntry->getDescription(), '->getDescription() must return null on initialization');

        $value = 'a description';
        $timeEntry->setDescription($value);
        $this->assertEquals($value, $timeEntry->getDescription(), '->getDescription() must return the value set');
    }

    /**
     * Test that the date property is properly handled.
     */
    public function testDate()
    {
        $timeEntry = new TimeEntry();

        $this->assertNull($timeEntry->getDate(), '->getDate() must return null on initialization');

        $value = new \DateTime();
        $timeEntry->setDate($value);
        $this->assertEquals($value, $timeEntry->getDate(), '->getDate() must return the value set');
    }

    /**
     * Test that the duration property is properly handled.
     */
    public function testDuration()
    {
        $timeEntry = new TimeEntry();

        $this->assertNull($timeEntry->getDuration(), '->getDuration() must return null on initialization');

        $value = 10;
        $timeEntry->setDuration($value);
        $this->assertEquals($value, $timeEntry->getDuration(), '->getDuration() must return the value set');
    }
}
