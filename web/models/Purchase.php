<?php
require_once __DIR__ . '/Database.php';


class Purchase
{
    private static function get_conn()
    {
        return (new Database())->pdo;
    }

    public static function make_purchase()
    {
        $conn = Purchase::get_conn();
        $sql =
            'INSERT INTO purchase
            (
                id_purchase,
                id_user,
                date_purchase
            ) VALUES (
                :id_purchase,
                :id_user,
                now()
            );';

        $id_purchase = uniqid();

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_purchase', $id_purchase);
        $stm->bindValue(':id_user', $_SESSION['id_user']);
        $stm->execute();

        $sql =
            'INSERT INTO purchase_product
            (
                id_purchase,
                id_prod,
                quantity_prod
            ) VALUES (
                :id_purchase,
                :id_prod,
                :quantity_prod
            );';

        foreach ($_SESSION['cart'] as $id_product => $quantity) {
            $stm = $conn->prepare($sql);
            $stm->bindValue(':id_purchase', $id_purchase);
            $stm->bindValue(':id_prod', $id_product);
            $stm->bindValue(':quantity_prod', $quantity);
            $stm->execute();
        }

        return $id_purchase;
    }

    public static function remove_from_cart($id_prod)
    {
        unset($_SESSION['cart'][$id_prod]);
    }

    public static function get_purchases_by_user($id_user)
    {
        $conn = Purchase::get_conn();
        $sql =
            'SELECT * FROM orders
            WHERE id_user = :id_user
            ORDER BY date_purchase DESC;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_user', $id_user);
        $stm->execute();

        return $stm->fetchAll();
    }

    public static function get_purchase_by_id($id_purchase)
    {
        $conn = Purchase::get_conn();
        $sql =
            'SELECT * FROM orders
            WHERE id_purchase = :id_purchase
            ORDER BY date_purchase DESC;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_purchase', $id_purchase);
        $stm->execute();

        return $stm->fetch();
    }

    public static function get_purchase_items($id_purchase)
    {
        $conn = Purchase::get_conn();
        $sql =
            'SELECT * FROM order_items
            WHERE id_purchase = :id_purchase;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_purchase', $id_purchase);
        $stm->execute();

        return $stm->fetchAll();
    }

    public static function get_all_purchases()
    {
        $conn = Purchase::get_conn();
        $sql = 'SELECT * FROM orders ORDER BY date_purchase DESC;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }
}
