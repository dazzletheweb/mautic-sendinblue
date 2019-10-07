<?php

namespace MauticPlugin\MauticSendinblueBundle\Swiftmailer\Callback;

use Mautic\LeadBundle\Entity\DoNotContact;

/**
 * Class CallbackEnum.
 */
class CallbackEnum
{

    const ERROR = 'error';
    const SOFT_BOUNCE = 'soft_bounce';
    const HARD_BOUNCE = 'hard_bounce';
    const INVALID_EMAIL = 'invalid_email';
    const SPAM = 'spam';
    const BLOCKED = 'blocked';
    const UNSUBSCRIBED = 'unsubscribed';

    /**
     * Checks if the event have to be processed.
     *
     * @param string $event
     *
     * @return bool
     */
    public static function shouldBeEventProcessed($event)
    {
        return in_array($event, self::getSupportedEvents(), true);
    }

    /**
     * Converts an event name to DNC reason.
     *
     * @param $event
     *
     * @return string|null
     */
    public static function convertEventToDncReason($event)
    {
        if (!self::shouldBeEventProcessed($event)) {
            return null;
        }

        $mapping = self::eventMappingToDncReason();

        return $mapping[$event];
    }

    /**
     *  Returns an array of supported Sendinblue events.
     *
     * @return array
     */
    private static function getSupportedEvents()
    {
        return [
            self::ERROR,
            self::SOFT_BOUNCE,
            self::HARD_BOUNCE,
            self::INVALID_EMAIL,
            self::SPAM,
            self::BLOCKED,
            self::UNSUBSCRIBED,
        ];
    }

    /**
     * Mapping Sendinblue events and DNC reasons.
     *
     * @return array
     */
    private static function eventMappingToDncReason()
    {
        return [
            self::ERROR => DoNotContact::BOUNCED,
            self::SOFT_BOUNCE => DoNotContact::BOUNCED,
            self::HARD_BOUNCE => DoNotContact::BOUNCED,
            self::INVALID_EMAIL => DoNotContact::BOUNCED,
            self::SPAM => DoNotContact::BOUNCED,
            self::BLOCKED => DoNotContact::BOUNCED,
            self::UNSUBSCRIBED => DoNotContact::UNSUBSCRIBED,
        ];
    }

}
