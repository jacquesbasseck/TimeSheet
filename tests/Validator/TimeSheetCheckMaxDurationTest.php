<?php
/**
 * Created by PhpStorm.
 * User: basseck
 * Date: 26/02/18
 * Time: 11:51
 */

namespace UCS\Component\TimeSheet\Tests\Validator;


use DateTime;
use Symfony\Component\Translation\TranslatorInterface;
use UCS\Component\TimeSheet\TimeEntry;
use UCS\Component\TimeSheet\TimeSheet;
use UCS\Component\TimeSheet\TimeSheetInterface;
use UCS\Component\TimeSheet\Validator\TimeSheetCheckMaxDuration;
use UCS\Component\TimeSheet\Validator\TimeSheetValidationContext;

class TimeSheetCheckMaxDurationTest extends \PHPUnit_Framework_TestCase
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


    public function testBadDuration()
    {
        $timeSheet = new TimeSheet();
        $timeSheet->setSubmittedAt(new DateTime());
        $timeSheet->setValidatedAt(new DateTime());

        $entry = new TimeEntry();
        $entry->setDate(new DateTime());
        $entry->setDuration(20);

        $timeSheet->addEntry($entry);

        $timeSheetValidationContext = $this->getValidationContext($timeSheet);
        $timeSheetCheckMaxDuration = new TimeSheetCheckMaxDuration();
        $this->assertFalse($timeSheetCheckMaxDuration->validate($timeSheetValidationContext));
    }


    /**
     * @return TimeSheetValidationContext
     */
    private function getValidationContext(TimeSheetInterface $timeSheet)
    {
        return new TimeSheetValidationContext($this->translator, 'messages', $timeSheet);
    }
}