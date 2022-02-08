<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Product.php';
require_once __DIR__ . '/User.php';


class Avaliation
{
    function __construct(int $id_aval, int $score, string $comment, User $user, int $id_prod, $date)
    {
        if ($score < 0 || $score > 5)
            throw new ValueError('Avaliation outside boundries');

        if (strlen($comment) > 300)
            throw new ValueError('Comment too long');

        $this->id_aval = $id_aval;
        $this->score = $score;
        $this->comment = $comment;
        $this->user = $user;
        $this->id_prod = $id_prod;
        $this->date = $date;
    }

    public static function get_conn()
    {
        return (new Database())->pdo;
    }

    public static function get_avaliations($id_product): array
    {
        $conn = Avaliation::get_conn();
        $sql = 'SELECT * FROM avaliation_user WHERE id_prod = :id_prod';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_prod', $id_product);
        $stm->execute();

        $avaliations = array();

        foreach ($stm->fetchAll() as $row) {
            $avaliations[] = new Avaliation(
                (int) $row['id'],
                (int) $row['score'],
                (string) $row['comment'],
                new User(
                    (int) $row['id_user'],
                    $row['name'],
                    $row['email'],
                    null,
                    $row['city'],
                    null,
                    null,
                    '00000000'
                ),
                (int) $row['id_prod'],
                $row['date']
            );
        }

        return $avaliations;
    }

    /**
     * Loads the five stars avaliations of a product, inside `span`s.
     */
    public static function load_stars($score)
    {
        for ($_ = 0; $_ < 5; $_++) {
            if ($score > 0.5)
                echo '<span style="color: #ffb200;" class="bi bi-star-fill"></span>';

            elseif ($score == 0.5)
                echo '<span style="color: #ffb200;" class="bi bi-star-half"></span>';

            else
                echo '<span style="color: #ffb200;" class="bi bi-star"></span>';

            --$score;
        }
    }

    /**
     * Inserts an avaliation into the database.
     */
    public function insert()
    {
        $conn = Avaliation::get_conn();
        $sql =
            'INSERT INTO avaliation
            (
                id_user,
                id_prod,
                comment_aval,
                score_aval,
                date_aval
            ) VALUES (
                :id_user,
                :id_prod,
                :comment,
                :score,
                now()
            );';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_user', $this->user->id);
        $stm->bindValue(':id_prod', $this->id_prod);
        $stm->bindValue(':comment', $this->comment);
        $stm->bindValue(':score', $this->score);
        $stm->execute();
    }
}
