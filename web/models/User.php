<?php

require_once __DIR__ . '/Database.php';

class User
{
    /**
     * Creates a new User instance.
     */
    public function __construct($nome, $endereco, $cidade, $cep)
    {
        $this->nome = $nome;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->cep = $cep;
    }

    /**
     * Gets a PDO connection to the database.
     */
    private static function get_conn()
    {
        return (new Database())->pdo;
    }

    /**
     * Inserts an user to the database.
     */
    public function insert_user()
    {
        $conn = User::get_conn();

        $sql =
        'INSERT INTO user (
            name_user,
            email_user,
            password_user,
            level_user,
            address_user,
            city_user,
            cep_user    
        ) values (
            :nome,
            :email,
            :senha,
            0,
            :endereco,
            :cidade,
            :cep
        );';

        $stm = $conn->prepare($sql);

        $stm->bindValue(':nome', $this->nome);
        $stm->bindValue(':email', $this->email);
        $stm->bindValue(':senha', $this->senha);
        $stm->bindValue(':endereco', $this->endereco);
        $stm->bindValue(':cidade', $this->cidade);
        $stm->bindValue(':cep', $this->cep);

        try {
            $stm->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Gets the first name of an user, using its id.
     */
    public static function get_username($id)
    {
        $conn = User::get_conn();

        $sql = 'SELECT name_user from user where id_user = :id;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);

        $stm->execute();

        $full_name = $stm->fetchAll()[0]['name_user'];

        $fisrt_name = explode(' ', $full_name)[0];

        $_SESSION['name_user'] = $fisrt_name;
    }
}
