<?php

declare(strict_types=1);

namespace LegacyCheckout;

use Stripe\PaymentIntent;
use Stripe\StripeClient;

final class LegacyChargeLookup
{
    /**
     * Legacy implementation for Stripe API versions before 2022-11-15.
     */
    public function lastChargeId(PaymentIntent $intent): ?string
    {
        return $intent->charges->data[0]->id ?? null;
    }

    /**
     * Explicit request-level API pin used to make the migration reproducible.
     */
    public function fetchLastChargeId(StripeClient $stripe, string $paymentIntentId): ?string
    {
        $intent = $stripe->paymentIntents->retrieve($paymentIntentId, [], [
            'stripe_version' => '2022-08-01',
        ]);

        return $intent->charges->data[0]->id ?? null;
    }
}
