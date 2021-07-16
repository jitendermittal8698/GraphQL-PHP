<?php

/**
 * @file
 */

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$book = new ObjectType([
  'name' => 'Book',
  'fields' => [
    'id'        => Type::id(),
    'title' => Type::string(),
    'year' => Type::int(),
    'isbn' => Type::string(),
    'price' => [
      'type' => Type::float(),
      'args' => [
        'unit' => ['type' => $priceEnum],
      ],
      'resolve' => static function ($rootValue, array $args) {
        if ($args['unit'] == 'USD') {
          return $rootValue['price'] / 74;
        }
        elseif ($args['unit'] == 'AUD') {
          return $rootValue['price'] / 56;
        }
        else {
          return $rootValue['price'];
        }
      },
    ],
  ],
]);

$author = new ObjectType([
  'name' => 'Author',
  'fields' => [
    'id'        => Type::id(),
    'firstName' => Type::string(),
    'lastName'  => Type::string(),
    'books' => [
      'type' => Type::listOf($book),
      'resolve' => static function ($rootValue, array $args) {
        if (isset($rootValue['id'])) {
          return DataSource::findBookForAuthor($rootValue['id']);
        }
      },
    ],
  ],
]);

