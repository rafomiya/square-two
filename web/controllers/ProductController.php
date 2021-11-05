<?php
class ProductController
{
    public static function index()
    {
        session_start();

        $page_title = 'Início';
        require_once __DIR__ . '/../layout_products.php';
    }

    public static function brand()
    {
        session_start();

        $child_view = 'brand.php';
        $page_title = 'Marca';
        require_once __DIR__ . '/../layout_products.php';
    }

    public static function category()
    {
        session_start();

        $child_view = 'category.php';
        $page_title = 'Categorias';
        require_once __DIR__ . '/../layout_products.php';
    }

    public static function new()
    {
        session_start();

        $page_title = 'Lançamentos';
        $child_view = 'new.php';
        require_once __DIR__ . '/../layout_products.php';
    }

    public static function search()
    {
        session_start();

        $child_view = 'search.php';
        $page_title = 'Pesquisa';
        require_once __DIR__ . '/../layout_products.php';
    }
}
