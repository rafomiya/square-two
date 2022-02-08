<?php
class Database
{

    const HASH_COST = 13;

    /**
     * Defines a Database instance.
     */
    function __construct()
    {
        $server = getenv('DB_SERVER');
        $user = getenv('DB_USER');
        $dbname = getenv('DB_NAME');
        $password = getenv('DB_PASSWORD');

        try {
            $this->pdo = new PDO('mysql:dbname=' . $dbname . ';host=' . $server, $user, $password);
        } catch (PDOException $e) {
            echo '<script>console.log("Database connection failed:\n\n' . $e->getMessage() . '")</script>';
            echo '<script>document.location = "../views/error.php"</script>';
        }
    }
}
