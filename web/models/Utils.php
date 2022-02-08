<?php
require_once __DIR__ . '/../../vendor/autoload.php';


use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;


class Utils
{
    static function handle_unlogged_user($id_user = 0)
    {
        if ($_SESSION['level_user'] == 1)
            return;

        if (!isset($_SESSION['id_user']))
            echo '<script>document.location = "../controllers/login.php";<script>';

        if ($id_user != 0 && $_SESSION['id_user'] != $id_user)
            echo '<script>document.location = "../controllers/index.php";</script>';
    }

    static function handle_not_admin()
    {
        if (!isset($_SESSION['id_user']))
            echo '<script>document.location = "../controllers/index.php";</script>';
    }

    static function render_view($child_view, $page_title, $layout_file = 'layout_beheaded.php', $data = array())
    {
        require_once __DIR__ . '/../' . $layout_file;
    }

    static function is_admin()
    {
        return isset($_SESSION['id_user']) && $_SESSION['level_user'] == 1;
    }

    public static function send_email($to, $subject, $message)
    {
        $url = 'https://node-api-email.herokuapp.com/';

        $data = array(
            'to' => $to,
            'subject' => $subject,
            'text' => $message,
            'sender' => getenv('EMAIL_SENDER'),
            'password' => getenv('PASSWORD_SENDER')
        );

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($curl);
        curl_close($curl);

        return $result;
    }

    public static function upload_to_bucket($filename, $file)
    {
        $s3 = new S3Client([
            'version' => 'latest',
            'region'  => 'us-east-1',
            'credentials' => [
                'key' => getenv('AWS_KEY_ID'),
                'secret' => getenv('AWS_SECRET_KEY')
            ]
        ]);

        return $s3->putObject([
            'Bucket' => getenv('AWS_S3_BUCKET'),
            'Key'    => $filename,
            'Body'   => 'Hello, world!',
            'SourceFile' => $file
        ]);
    }
}
