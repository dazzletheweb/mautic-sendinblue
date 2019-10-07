<?php

return [
    'name'        => 'Sendinblue integration',
    'description' => 'Allows to send E-mails with Sendinblue',
    'version'     => '1.0',
    'author'      => 'Dazzle',
    'services'    => [
        'other' => [
            'mautic.transport.sendinblue_api' => [
                'class' => \MauticPlugin\MauticSendinblueBundle\Swiftmailer\Transport\SendinblueApiTransport::class,
                'arguments' => [
                    '%mautic.mailer_api_key%',
                    'translator',
                    'mautic.transport.sendinblue_api.callback',
                ],
                'tags' => [
                    'mautic.email_transport',
                ],
                'tagArguments' => [
                    [
                        'transport_alias' => 'mautic.email.config.mailer_transport.sendinblue',
                        'field_api_key' => true,
                    ],
                ],
            ],
            'mautic.transport.sendinblue_api.callback' => [
                'class' => \MauticPlugin\MauticSendinblueBundle\Swiftmailer\Callback\SendinblueApiCallback::class,
                'arguments' => [
                    'mautic.email.model.transport_callback',
                    'monolog.logger.mautic',
                ],
            ],
        ],
    ],
];
