<?php
use PHPMailer\PHPMailer\PHPMailer;
require __DIR__."/vendor/autoload.php";

$success = array("operation" => true);
$fail = array("operation" => false);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

if(empty($_POST)) {
    echo json_encode($fail);
    exit(0);
} else {
    if(array_key_exists('name', $_POST) && array_key_exists('email', $_POST) && array_key_exists('subject', $_POST) && array_key_exists('message', $_POST)) {
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $subject = strip_tags($_POST['subject']);
        $message = strip_tags($_POST['message']);
        if($name && $email && $subject && $message) {
            $mailer = new Mailer\Mailer();
            $mail = new PHPMailer(true);
            $val = $mailer->phpMailer($mail,$_POST['email'],$_POST['name'],$_POST['subject'],$_POST['message']);
            if($val) {
                echo json_encode($success);
                exit(0);
            } else {
                echo json_encode($fail);
                exit(0);
            }
        } else {
            echo json_encode($fail);
            exit(0);
        }
    } else {
        echo json_encode($fail);
        exit(0);
    }
}
?>