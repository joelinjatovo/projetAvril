<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\WebhookController as BaseController;

class WebhookController extends BaseController
{
    public function handleInvoicePaymentSucceeded($payload)
    {
      // Handle The Event
    }
    
    /**
     * Handle a Braintree webhook.
     *
     * @param  WebhookNotification  $webhook
     * @return Response
     */
    public function handleDisputeOpened(WebhookNotification $notification)
    {
        // Handle The Event
    }
}
