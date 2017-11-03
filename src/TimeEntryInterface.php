<?php

/*
 * This file is part of the OpenTimeTracker package.
 *
 * Copyright 2015 Nicolas Macherey <nicolas.macherey@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UCS\Component\TimeSheet;

/**
 * Interface TimeEntryInterface.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
interface TimeEntryInterface
{
    /**
     * Get the work description can be empty but preferable to be as expressive as possible.
     *
     * @return string
     */
    public function getDescription();

    /**
     * @param string $description
     *
     * @return TimeEntryInterface
     */
    public function setDescription($description);

    /**
     * @return \DateTime
     */
    public function getDate();

    /**
     * @param \DateTime $date
     *
     * @return TimeEntryInterface
     */
    public function setDate(\DateTime $date);

    /**
     * @return int
     */
    public function getDuration();

    /**
     * Set the total work duration expressed in hours.
     *
     * @param int $duration
     *
     * @return TimeEntryInterface
     */
    public function setDuration($duration);

    /**
     * @return TimeSheetInterface
     */
    public function getTimeSheet();

    /**
     * @param TimeSheetInterface $timeSheet
     *
     * @return TimeEntryInterface
     */
    public function setTimeSheet(TimeSheetInterface $timeSheet);
}
