<?php
class Database
{
    /**
     * Defines a Database instance.
     */

    const HASH_COST = 13;

    function __construct()
    {
        $server = getenv('LOCAL_SERVER');
        $user = getenv('LOCAL_USER');
        $dbname = getenv('LOCAL_NAME');
        $password = getenv('LOCAL_PASSWORD');

        try {
            $this->pdo = new PDO('mysql:dbname=' . $dbname . ';host=' . $server, $user, $password);
        } catch (PDOException $e) {
            if (str_contains(strtolower($e->getMessage()), 'connection refused')) {
                $server = getenv('DB_SERVER');
                $user = getenv('DB_USER');
                $dbname = getenv('DB_NAME');
                $password = getenv('DB_PASSWORD');
                
                try {
                    $this->pdo = new PDO('mysql:dbname=' . $dbname . ';host=' . $server, $user, $password);
                } catch (Exception $e) {
                    echo '<script>document.location = "../views/error.php"</script>';
                }
            }
        }
    }
}
