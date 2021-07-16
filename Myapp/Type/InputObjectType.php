<?php

/**
 * @file
 */

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

$authorInput = new InputObjectType([
  'name' => 'AuthorInput',
  'fields' => [
    'id'        => Type::id(),
    'firstName' => Type::string(),
    'lastName'  => Type::string(),
  ],
]);
