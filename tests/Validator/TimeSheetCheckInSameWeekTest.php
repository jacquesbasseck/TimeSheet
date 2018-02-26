<?php
/**
 * Created by PhpStorm.
 * User: basseck
 * Date: 26/02/18
 * Time: 12:14
 */

namespace UCS\Component\TimeSheet\Tests\Validator;


use Symfony\Component\Translation\TranslatorInterface;
use UCS\Component\TimeSheet\TimeEntry;
use UCS\Component\TimeSheet\TimeSheet;
use UCS\Component\TimeSheet\TimeSheetInterface;
use UCS\Component\TimeSheet\Validator\TimeSheetCheckInSameWeek;
use UCS\Component\TimeSheet\Validator\TimeSheetCheckMaxDuration;
use UCS\Component\TimeSheet\Validator\TimeSheetValidationContext;

class TimeSheetCheckInSameWeekTest
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


    public function testNotInSameWeek()
    {
        $timeSheet = new TimeSheet();
        $timeSheet->setSubmittedAt(new \DateTime());
        $timeSheet->setValidatedAt(new \DateTime());

        $entry = new TimeEntry();
        $entry->setDate(new \DateTime());
        $entry->setDuration(6);

        $timeSheet->addEntry($entry);

        $entry1 = new TimeEntry();
        $entry1->setDate((new \DateTime())->modify('+10 day'));
        $entry1->setDuration(10);

        $timeSheet->addEntry($entry1);


        $timeSheetValidationContext = $this->getValidationContext($timeSheet);
        $timeSheetCheckInSameWeek = new TimeSheetCheckInSameWeek();
        $this->assertFalse($timeSheetCheckInSameWeek->validate($timeSheetValidationContext));
    }


    /**
     * @return TimeSheetValidationContext
     */
    private function getValidationContext(TimeSheetInterface $timeSheet)
    {
        return new TimeSheetValidationContext($this->translator, 'messages', $timeSheet);
    }
}