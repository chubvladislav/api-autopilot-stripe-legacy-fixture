# API Autopilot Stripe legacy fixture

This public repository is intentionally outdated and exists only for testing API Autopilot.

`LegacyChargeLookup` reads `PaymentIntent.charges`, which was removed from Stripe API responses in version `2022-11-15`. The intended migration target is `PaymentIntent.latest_charge` while preserving the function contract: return the last charge ID or `null`.

## Baseline

```bash
composer install
vendor/bin/phpunit
```

The baseline tests describe the old API contract and are expected to pass before an Autopilot migration run.

No Stripe keys, real payments, webhooks, network calls, or customer data are used.
