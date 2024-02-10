<?php
// Connect to the database,and execute the query
class Database
{
  public $connection;

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
    $dsn              = 'mysql:' . http_build_query($config, '', ';');
    $this->connection = new PDO($dsn, $username, $password, [
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }
  function query($query, $params = [])
  {
    $statement = $this->connection->prepare($query);
    $statement->execute($params);

    return $statement;
  }
}
