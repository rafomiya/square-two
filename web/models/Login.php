<?php
require_once __DIR__ . '/Database.php';


class Login
{
    /**
     * Creates a new instance of Login.
     */
    public function __construct($email, $senha)
    {
        $this->email = $email;
        $this->senha = $senha;
    }

    /**
     * Gets a PDO connection to the databasel.
     */
    private static function get_conn()
    {
        return (new Database())->pdo;
    }

    /**
     * Returns the id of the user, or false, if it's not registered.
     */
    public function validate()
    {
        $conn = Login::get_conn();

        $sql = 'SELECT id_user, password_user from user where email_user = :email;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':email', $this->email);
        $stm->execute();

        $rows = $stm->fetchAll();
        
        if (count($rows) > 0) {
            $senha = $rows[0]['password_user'];

            if (password_verify($this->senha, $senha))
                return $rows[0]['id_user'];
        }

        return False;
    }
}
