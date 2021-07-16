<?php

/**
 * @file
 */

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/Data/DataSource.php';
require __DIR__ . '/Type/EnumType.php';
require __DIR__ . '/Type/InputObjectType.php';
require __DIR__ . '/Type/ObjectType.php';
require __DIR__ . '/EntryPoint/EntryPoints.php';

use GraphQL\GraphQL;
use GraphQL\Type\Schema;

try {
  DataSource::init();

  $schema = new Schema([
    'query' => $queryType,
    'mutation' => $mutationType,
  ]);

  $rawInput       = file_get_contents('php://input');
  $input          = json_decode($rawInput, TRUE);
  $query          = $input['query'];
  $variableValues = $input['variables'] ?? NULL;

  $rootValue = ['prefix' => 'You said: '];
  $result    = GraphQL::executeQuery($schema, $query, $rootValue, NULL, $variableValues);
  $output    = $result->toArray();
}
catch (Throwable $e) {
  $output = [
    'error' => [
      'message' => $e->getMessage(),
    ],
  ];
}

header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);
