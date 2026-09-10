<?php

declare(strict_types=1);

namespace LegacyCheckout\Tests;

use LegacyCheckout\LegacyChargeLookup;
use PHPUnit\Framework\TestCase;
use Stripe\PaymentIntent;

final class LegacyChargeLookupTest extends TestCase
{
    public function test_it_returns_the_last_charge_id_from_the_legacy_collection(): void
    {
        $intent = PaymentIntent::constructFrom([
            'id' => 'pi_fixture',
            'charges' => [
                'object' => 'list',
                'data' => [['id' => 'ch_legacy_fixture', 'object' => 'charge']],
            ],
        ]);

        self::assertSame('ch_legacy_fixture', (new LegacyChargeLookup())->lastChargeId($intent));
    }

    public function test_it_returns_null_when_the_legacy_collection_is_empty(): void
    {
        $intent = PaymentIntent::constructFrom([
            'id' => 'pi_fixture_empty',
            'charges' => ['object' => 'list', 'data' => []],
        ]);

        self::assertNull((new LegacyChargeLookup())->lastChargeId($intent));
    }
}
