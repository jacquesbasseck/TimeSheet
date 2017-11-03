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

/* Imports */
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface TimeSheetInterface.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
interface TimeSheetInterface
{
    /**
     * @return UserInterface
     */
    public function getSubmittedBy();

    /**
     * @param UserInterface $user
     *
     * @return TimeSheetInterface
     */
    public function setSubmittedBy(UserInterface $user);

    /**
     * @return \DateTime
     */
    public function getSubmittedAt();

    /**
     * @param \DateTime|null $submittedAt
     *
     * @return TimeSheetInterface
     */
    public function setSubmittedAt(\DateTime $submittedAt = null);

    /**
     * @return UserInterface
     */
    public function getValidatedBy();

    /**
     * @param UserInterface $user
     *
     * @return TimeSheetInterface
     */
    public function setValidatedBy(UserInterface $user);

    /**
     * @return \DateTime
     */
    public function getValidatedAt();

    /**
     * @param \DateTime|null $validatedAt
     *
     * @return TimeSheetInterface
     */
    public function setValidatedAt(\DateTime $validatedAt = null);

    /**
     * @return TimeEntryInterface[]
     */
    public function getEntries();

    /**
     * @param TimeEntryInterface $entry
     *
     * @return TimeSheetInterface
     */
    public function addEntry(TimeEntryInterface $entry);

    /**
     * @param TimeEntryInterface $entry
     *
     * @return TimeSheetInterface
     */
    public function removeEntry(TimeEntryInterface $entry);

    /**
     * @return TimeSheetInterface
     */
    public function clearEntries();
}
