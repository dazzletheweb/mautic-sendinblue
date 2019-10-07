<?php

namespace MauticPlugin\MauticSendinblueBundle\Swiftmailer\Callback;

use Mautic\EmailBundle\Model\TransportCallback;
use MauticPlugin\MauticSendinblueBundle\Swiftmailer\Exception\ResponseItemException;
use Symfony\Component\HttpFoundation\Request;
use Monolog\Logger;

/**
 * Class SendinblueApiCallback.
 */
class SendinblueApiCallback
{

    /**
     * @var TransportCallback
     */
    private $transportCallback;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * SendinblueApiCallback constructor.
     *
     * @param TransportCallback $transportCallback
     * @param Logger $logger
     */
    public function __construct(TransportCallback $transportCallback, Logger $logger)
    {
        $this->transportCallback = $transportCallback;
        $this->logger = $logger;
    }

    /**
     * Processes Sendinblue API callback request.
     *
     * @param Request $request
     */
    public function processCallbackRequest(Request $request)
    {
        $parameters = $request->request->all();

        if (isset($parameters['event']) && CallbackEnum::shouldBeEventProcessed($parameters['event'])) {
            try {
                $item = new ResponseItem($parameters);
                $this->transportCallback->addFailureByAddress($item->getEmail(), $item->getReason(), $item->getDncReason());
            }
            catch (ResponseItemException $e) {
                $this->logger->log('error', $e->getMessage());
            }
        }
    }

}
