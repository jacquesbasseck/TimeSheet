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
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class TimeSheet.
 *
 * @author Nicolas Macherey <nicolas.macherey@gmail.com>
 */
class TimeSheet implements TimeSheetInterface
{
    /**
     * @var UserInterface
     */
    protected $submittedBy;

    /**
     * @var \DateTime
     */
    protected $submittedAt;

    /**
     * @var UserInterface
     */
    protected $validatedBy;

    /**
     * @var \DateTime
     */
    protected $validatedAt;

    /**
     * @var TimeEntryInterface[]
     */
    protected $entries;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    /**
     * {@inheritdoc}
     */
    public function getSubmittedBy()
    {
        return $this->submittedBy;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubmittedBy(UserInterface $submittedBy)
    {
        $this->submittedBy = $submittedBy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubmittedAt()
    {
        return $this->submittedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setSubmittedAt(\DateTime $submittedAt = null)
    {
        $this->submittedAt = $submittedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidatedBy()
    {
        return $this->validatedBy;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidatedBy(UserInterface $validatedBy = null)
    {
        $this->validatedBy = $validatedBy;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidatedAt()
    {
        return $this->validatedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function setValidatedAt(\DateTime $validatedAt = null)
    {
        $this->validatedAt = $validatedAt;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * {@inheritdoc}
     */
    public function addEntry(TimeEntryInterface $entry)
    {
        if (!$this->entries->contains($entry)) {
            $this->entries->add($entry);
            $entry->setTimeSheet($this);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function removeEntry(TimeEntryInterface $entry)
    {
        $this->entries->removeElement($entry);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clearEntries()
    {
        $this->entries->clear();

        return $this;
    }
}
