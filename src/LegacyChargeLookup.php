<?php

declare(strict_types=1);

namespace LegacyCheckout;

use Stripe\PaymentIntent;

final class LegacyChargeLookup
{
    /**
     * Legacy implementation for Stripe API versions before 2022-11-15.
     */
    public function lastChargeId(PaymentIntent $intent): ?string
    {
        return $intent->charges->data[0]->id ?? null;
    }
}
