<?php
/**
 * Created by PhpStorm.
 * User: basseck
 * Date: 26/02/18
 * Time: 10:52
 */

namespace UCS\Component\TimeSheet\Validator;


use Doctrine\Common\Collections\ArrayCollection;

class TimeSheetCheckMaxDuration implements TimeSheetValidationRuleInterface
{
    const MAX_HOURS_DURATION_DAY = 10;
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'duration-violation';
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
        $violations = 0;
        $entries = $validationContext->getTimeSheet()->getEntries();
        if (!$entries->isEmpty()) {
            foreach ($entries as $entry) {
                if ($entry->getDuration() > self::MAX_HOURS_DURATION_DAY) {
                    $violations++;
                }

            }
        }

        $validationContext->addViolation('La duree max est depassé');

        return $violations === 0;
    }
}