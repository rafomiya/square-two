<?php

require_once __DIR__ . '/Database.php';

class User
{
    /**
     * Creates a new User instance.
     */
    public function __construct($nome, $email, $senha, $cidade, $endereco, $num_endereco, $cep, $nivel = 0)
    {
        $cep = str_replace('-', '', $cep);
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->cidade = $cidade;
        $this->endereco = $endereco;
        $this->num_endereco = $num_endereco;
        $this->cep = $cep;
        $this->nivel = $nivel;
        if (strlen($cep) != 8)
            throw new InvalidArgumentException('CEP incorreto.');
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
    public function insert()
    {
        $conn = User::get_conn();

        $sql =
            'INSERT INTO user (
            name_user,
            email_user,
            password_user,
            level_user,
            city_user,
            address_user,
            address_number,
            cep_user
        ) values (
            :nome,
            :email,
            :senha,
            :nivel,
            :cidade,
            :endereco,
            :numero_endereco,
            :cep
        );';

        $stm = $conn->prepare($sql);

        $hashed_pw = password_hash($this->senha, PASSWORD_BCRYPT, array('cost' => Database::HASH_COST));

        $stm->bindValue(':nome', $this->nome);
        $stm->bindValue(':email', $this->email);
        $stm->bindValue(':senha', $hashed_pw);
        $stm->bindValue(':nivel', $this->nivel);
        $stm->bindValue(':cidade', $this->cidade);
        $stm->bindValue(':endereco', $this->endereco);
        $stm->bindValue(':numero_endereco', $this->num_endereco);
        $stm->bindValue(':cep', $this->cep);

        $stm->execute();
    }

    /**
     * Gets the first name of an user, using its id.
     */
    public static function set_session($id)
    {
        $conn = User::get_conn();

        $sql = 'SELECT name_user, level_user from user where id_user = :id;';
        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        $row = $stm->fetchAll()[0];

        $full_name = $row['name_user'];
        $fisrt_name = explode(' ', $full_name)[0];

        $_SESSION['id_user'] = $id;
        $_SESSION['level_user'] = $row['level_user'];
        $_SESSION['name_user'] = $fisrt_name;
    }

    // fazer consistencia do cpf

}
