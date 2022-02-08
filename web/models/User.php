<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Utils.php';

class User
{
    /**
     * Creates a new User instance.
     */
    public function __construct($id, $nome, $email, $senha, $cidade, $endereco, $num_endereco, $cep, $nivel = 0)
    {
        $this->id = $id;
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
        $first_name = explode(' ', $full_name)[0];

        $_SESSION['id_user'] = $id;
        $_SESSION['level_user'] = $row['level_user'];
        $_SESSION['name_user'] = $first_name;
    }

    public static function email_exists($email)
    {
        $conn = User::get_conn();
        $sql = 'SELECT COUNT(*) AS result FROM user WHERE email_user = :email;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':email', $email);
        $stm->execute();

        $result = $stm->fetchAll()[0]['result'];

        var_dump($result);
        return $result == '1';
    }

    public static function reset_password($email)
    {
        $message =
            'Olá! Você solicitou uma nova senha.\n' .
            '\n' .
            'Para criar uma nova senha, clique no link abaixo:\n' .
            'reset_password.php?email=' . $email . '\n' .
            '\n' .
            'Se você não solicitou uma nova senha, ignore este e-mail.\n' .
            '\n' .
            'Atenciosamente,\n' .
            'Equipe square-two.';

        $subject = 'Square-two - Nova senha';

        Utils::send_email($email, $subject, $message);
    }

    public static function get_user($id)
    {
        $conn = User::get_conn();
        $sql = 'SELECT * FROM user WHERE id_user = :id;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        $row = $stm->fetchAll()[0];

        return new User(
            $row['id_user'],
            $row['name_user'],
            $row['email_user'],
            $row['password_user'],
            $row['city_user'],
            $row['address_user'],
            $row['address_number'],
            $row['cep_user'],
            $row['level_user']
        );
    }

    public static function update($user)
    {
        $conn = User::get_conn();
        $sql =
            'UPDATE user
            set
                name_user = :nome,
                email_user = :email,
                password_user = :senha,
                city_user = :cidade,
                address_user = :endereco,
                address_number = :numero_endereco,
                cep_user = :cep
            where id_user = :id;';

        $hashed_pw = password_hash($user->senha, PASSWORD_BCRYPT, array('cost' => Database::HASH_COST));

        $stm = $conn->prepare($sql);
        $stm->bindValue(':nome', $user->nome);
        $stm->bindValue(':email', $user->email);
        $stm->bindValue(':senha', $hashed_pw);
        $stm->bindValue(':cidade', $user->cidade);
        $stm->bindValue(':endereco', $user->endereco);
        $stm->bindValue(':numero_endereco', $user->num_endereco);
        $stm->bindValue(':cep', $user->cep);
        $stm->bindValue(':id', (int) $user->id);
        var_dump($stm->execute());
    }

    public static function get_admins_emails()
    {
        $conn = User::get_conn();
        $sql = 'SELECT email_user FROM user WHERE level_user = 1;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        $emails = [];
        foreach ($stm->fetchAll() as $row)
            $emails[] = $row['email_user'];

        return implode(',', $emails);
    }

    public static function send_email_to_admins($subject, $message)
    {
        $emails = User::get_admins_emails();

        $result = Utils::send_email($emails, $subject, $message);

        return $result;
    }
}