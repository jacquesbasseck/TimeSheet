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
 * Class TimeEntry.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeEntry implements TimeEntryInterface
{
    /**
     * @var TimeSheetInterface
     */
    protected $timeSheet;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var int
     */
    protected $duration;

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
    public function setTimeSheet(TimeSheetInterface $timeSheet)
    {
        $this->timeSheet = $timeSheet;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * {@inheritdoc}
     */
    public function setDate(\DateTime $date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * {@inheritdoc}
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }
}
