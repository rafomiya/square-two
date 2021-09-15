<?php

require_once __DIR__ . '/Database.php';

class User
{
    private function __construct()
    {
    }

    public function create_login($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    private static function get_conn()
    {
        return (new Database())->pdo;
    }

    public function validate_login()
    {
        $conn = User::get_conn();

        $sql = "SELECT id_user from user where email_user = :email and password_user = :senha;";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":email", $this->email);
        $stm->bindValue(":senha", $this->password);

        $stm->execute();

        $rows = $stm->fetchAll();

        if ($rows->rowCount() != 1) {
            return FALSE;
        }
        return TRUE;
    }

    public function sign_up($nome, $email, $senha, $endereco, $cidade, $cep)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->cep = $cep;
    }

    public function insert_user()
    {
        $conn = User::get_conn();

        $sql = "INSERT INTO user (
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
        );";

        $stm = $conn->prepare($sql);

        $stm->bindValue(":nome", $this->nome);
        $stm->bindValue(":email", $this->email);
        $stm->bindValue(":senha", $this->senha);
        $stm->bindValue(":endereco", $this->endereco);
        $stm->bindValue(":cidade", $this->cidade);
        $stm->bindValue(":cep", $this->cep);

        try {
            $stm->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
