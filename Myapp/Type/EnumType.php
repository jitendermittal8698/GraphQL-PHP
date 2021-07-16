<?php

/**
 * @file
 */

use GraphQL\Type\Definition\EnumType;

$priceEnum = new EnumType([
  'name' => 'PriceValues',
  'values' => ['INR', 'USD', 'AUD'],
]);
