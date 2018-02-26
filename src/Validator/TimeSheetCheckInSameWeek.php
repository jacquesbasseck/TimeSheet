<?php
/**
 * Created by PhpStorm.
 * User: basseck
 * Date: 26/02/18
 * Time: 11:23
 */

namespace UCS\Component\TimeSheet\Validator;


use function array_keys;
use Doctrine\Common\Collections\ArrayCollection;

class TimeSheetCheckInSameWeek implements TimeSheetValidationRuleInterface
{

    /**
     * Returns a unique name for your password rule.
     *
     * @return string
     */
    public function getName()
    {
        return 'in-same-week-violation';
    }

    /**
     * Validate the current password accordingly to specific rules the password is accessible within the context.
     *
     * @param TimeSheetValidationContext $validationContext
     *
     * @return bool
     */
    public function validate(TimeSheetValidationContext $validationContext)
    {
        /** @var ArrayCollection $entries */
        $violations = [];
        $numWeek = null;
        $entries = $validationContext->getTimeSheet()->getEntries();
        if (!$entries->isEmpty()){
            $numWeek = date('W', $entries->current()->getDate()->getTimestamp());
            foreach ($entries as $entry) {
                if (date('W', $entry->getDate()->getTimestamp()) !== $numWeek) {
                    $violations[$entry->getDate()] = true;
                }

            }
        }
        $validationContext->addViolation('Pas dans la meme semaine', []);
        return empty($violations);
    }
}