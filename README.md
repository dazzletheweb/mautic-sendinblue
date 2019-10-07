# Mautic Sendinblue Plugin

[![license](https://img.shields.io/circleci/project/github/KonstantinCodes/mautic-recaptcha.svg)](https://circleci.com/gh/KonstantinCodes/mautic-recaptcha/tree/master) [![license](https://img.shields.io/packagist/v/koco/mautic-recaptcha-bundle.svg)](https://packagist.org/packages/koco/mautic-recaptcha-bundle) 
[![Packagist](https://img.shields.io/packagist/l/koco/mautic-recaptcha-bundle.svg)](LICENSE) [![mautic](https://img.shields.io/badge/mautic-%3E%3D%202.15.2-blue.svg)](https://www.mautic.org/mixin/recaptcha/)

This Plugin brings Sendinblue integration to Mautic 2.15.2 and newer.

Licensed under GNU General Public License v3.0.

## Installation via composer (preferred)
Execute `composer require dazzle/mautic-sendinblue-bundle` in the main directory of the Mautic installation.

## Installation via .zip
1. Download the [master.zip](https://github.com/dazzletheweb/mautic-sendinblue/archive/master.zip), extract it into the `plugins/` directory and rename the new directory to `MauticSendinblueBundle`.
2. Clear the cache via console command `php app/console cache:clear --env=prod` (might take a while) *OR* manually delete the `app/cache/prod` directory.

## Configuration

Navigate to the Plugins page and click "Install/Upgrade Plugins". You should now see a "Sendinblue integration" plugin.

### Emails
Navigate to the Configuration page and open Email Settings section. Set "Sendinblue - API" service to send email through and enter your Sendinblue API key (use v3).

### Webhooks
1. Navigate to your Sendinblue account and open the Webhook page in Transactional settings.
2. Add a new webhook:
    1. URL to call: https://SITENAME/mailer/sendinblue_api/callback
    2. Supported events:
        * Error
        * Soft Bounce
        * Hard Bounce
        * Invalid email
        * Complaint
        * Unsubscribed
        * Blocked
