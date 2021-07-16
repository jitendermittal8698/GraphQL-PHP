<?php

/**
 * Class DataSource.
 */
class DataSource {

  /**
   * Variable Authors.
   *
   * @var array
   *   authors.
   */
  static public $authors = [];

  /**
   * Variable Books.
   *
   * @var array
   *   books.
   */
  static public $books = [];

  /**
   *
   */
  public static function init() {
    self::$authors = [
      [
        'id' => '1',
        'firstName' => 'Mark One',
        'lastName' => 'Twain One',
      ],
      [
        'id' => '2',
        'firstName' => 'Mark Two',
        'lastName' => 'Twain Two',
      ],
      [
        'id' => '3',
        'firstName' => 'Mark Three',
        'lastName' => 'Twain Three',
      ],
      [
        'id' => '4',
        'firstName' => 'Mark Four',
        'lastName' => 'Twain Four',
      ],
      [
        'id' => '5',
        'firstName' => 'Mark Five',
        'lastName' => 'Twain Five',
      ],
    ];

    self::$books = [
      [
        'id' => 1,
        'title' => 'The Adventures of Tom Sawyer',
        'year' => 1876,
        'isbn' => '978-0996584838',
        'price' => 1500,
      ],
      [
        'id' => 1,
        'title' => 'The Adventures of Tom Sawyer Two',
        'year' => 1876,
        'isbn' => '978-0996584839',
        'price' => 1000,
      ],
      [
        'id' => 3,
        'title' => 'The Adventures of Tom Sawyer Three',
        'year' => 1876,
        'isbn' => '978-0996584840',
        'price' => 2000,
      ],
      [
        'id' => 4,
        'title' => 'The Adventures of Tom Sawyer Four',
        'year' => 1876,
        'isbn' => '978-0996584841',
        'price' => 1000,
      ],
      [
        'id' => 5,
        'title' => 'The Adventures of Tom Sawyer Five',
        'year' => 1876,
        'isbn' => '978-0996584842',
        'price' => 1200,
      ],
    ];
  }

  /**
   * Function Get Books.
   */
  public static function getBooks() {
    return self::$books;
  }

  /**
   *
   */
  public static function findBookForAuthor($author_id) {
    return array_filter(self::$books, function ($ele) use ($author_id) {
      return $ele['id'] == $author_id;
    });
  }

  /**
   *
   */
  public static function findBook($isbn) {
    return array_filter(self::$books, function ($ele) use ($isbn) {
      return $ele['isbn'] == $isbn;
    });
  }

  /**
   * Function Get Authors.
   */
  public static function getAuthors() {
    return self::$authors;
  }

  /**
   *
   */
  public static function findAuthor($id) {
    return array_filter(self::$authors, function ($ele) use ($id) {
      return $ele['id'] == $id;
    });
  }

  /**
   * Function Get Books.
   */
  public static function updateAuthor($id, $data) {
    $keyValue = 0;
    foreach (self::$authors as $key => $value) {
      if ($value['id'] == $id) {
        self::$authors[$key] = $data;
        $keyValue = $key;
      }
    }
    return self::$authors[$keyValue];
  }

  /**
   * Function Get Books.
   */
  public static function createAuthor($id, $data) {
    array_push(self::$authors, $data);
    return end(self::$authors);
  }

}
