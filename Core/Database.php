<?php

namespace Core;

use PDO;

class Database
{
  public $connection;
  public $statement;

  /**
   * Constructor for initializing the connection using the provided configuration.
   *
   * @param array $config The configuration array for establishing the database connection
   * @param string $username The username for establishing the database connection
   * @param string $password The password for establishing the database connection
   * @throws PDOException If there is an error establishing the database connection
   * @return void
   */
  public function __construct($config, $username = 'root', $password = '')
  {
    $dsn = 'mysql:' . http_build_query(
      $config,
      '',
      ';'
    );

    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  /**
   * Perform a query with optional parameters.
   *
   * @param string $query The SQL query to be executed
   * @param array $params An array of parameters to be bound to the query
   * @return $this The current object for method chaining
   */
  function query($query, $params = [])
  {
    $this->statement = $this->connection->prepare($query);
    $this->statement->execute($params);

    return $this;
  }

  function find()
  {
    return $this->statement->fetch();
  }
  public function get()
  {
    return $this->statement->fetchAll();
  }

  function findOrFail()
  {
    $result = $this->find();

    if (!$result) {
      abort(Response::NOT_FOUND);
    }

    return $result;
  }
}
