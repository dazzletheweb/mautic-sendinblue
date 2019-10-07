<?php

namespace MauticPlugin\MauticSendinblueBundle\Swiftmailer\Callback;

use MauticPlugin\MauticSendinblueBundle\Swiftmailer\Exception\ResponseItemException;

/**
 * Class ResponseItem.
 */
class ResponseItem
{

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $reason;

    /**
     * @var int
     */
    private $dncReason;

    /**
     * ResponseItem constructor.
     *
     * @param array $item
     *
     * @throws ResponseItemException
     */
    public function __construct(array $item)
    {
        if (!isset($item['email']) || (isset($item['email']) && empty($item['email']))) {
            throw new ResponseItemException('Email must not be empty.');
        }

        $this->email = is_array($item['email']) ? reset($item['email']) : $item['email'];
        $this->reason = isset($item['reason']) ? $item['reason'] : null;
        $this->dncReason = CallbackEnum::convertEventToDncReason($item['event']);
    }

    /**
     * Gets an email of the event.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Gets a reason of the event.
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Gets DNC reason of the event.
     *
     * @return int
     */
    public function getDncReason()
    {
        return $this->dncReason;
    }

}
