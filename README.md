# Install

After cloning repository you need to do that steps:

1. `composer update`
2. `vendor/bin/sail up -d`
3. `vendor/bin/sail npm install`
4. `vendor/bin/sail node node_modules/.bin/vite build`
5. `vendor/bin/sail restart`

# Run

Run with `vendor/bin/sail up`.

Run as daemon with `vendor/bin/sail up -d`.

Stop with `vendor/bin/sail stop`.

And restart with `vendor/bin/sail restart`.
