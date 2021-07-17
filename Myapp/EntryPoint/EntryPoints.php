<?php

/**
 * @file
 */

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$queryType = new ObjectType([
  'name' => 'Query',
  'fields' => [
    'hello' => [
      'type' => Type::string(),
      'resolve' => static function ($rootValue, array $args) {
        return 'Hello World!!!';
      },
    ],
    'echo' => [
      'type' => Type::string(),
      'args' => [
        'message' => ['type' => Type::string()],
      ],
      'resolve' => static function ($rootValue, array $args) {
        return $rootValue['prefix'] . $args['message'];
      },
    ],
    'authors' => [
      'type' => Type::listOf($author),
      'args' => [
        'id' => ['type' => Type::int()],
      ],
      'resolve' => static function ($rootValue, array $args) {
        if (isset($args['id'])) {
          return DataSource::findAuthor($args['id']);
        }
        else {
          return DataSource::getAuthors();
        }

      },
    ],
    'books' => [
      'type' => Type::listOf($book),
      'args' => [
        'isbn' => ['type' => Type::string()],
      ],
      'resolve' => static function ($rootValue, array $args) {
        if (isset($args['isbn'])) {
          return DataSource::findBook($args['isbn']);
        }
        else {
          return DataSource::getBooks();
        }
      },
    ],
  ],
]);

$mutationType = new ObjectType([
  'name' => 'Mutation',
  'fields' => [
    'updateAuthor' => [
      'type' => $author,
      'args' => [
        'id' => ['type' => Type::string()],
        'data' => ['type' => $authorInput],
      ],
      'resolve' => static function ($calc, array $args) {
        return DataSource::updateAuthor($args['id'], $args['data']);
      },
    ],
    'createAuthor' => [
      'type' => $author,
      'args' => [
        'data' => ['type' => $authorInput],
      ],
      'resolve' => static function ($calc, array $args) {
        return DataSource::createAuthor($args['data']);
      },
    ],
    'authors' => [
      'type' => Type::listOf($author),
      'args' => [
        'id' => ['type' => Type::int()],
      ],
      'resolve' => static function ($rootValue, array $args) {
        if (isset($args['id'])) {
          return DataSource::findAuthor($args['id']);
        }
        else {
          return DataSource::getAuthors();
        }
      },
    ],
  ],
]);
