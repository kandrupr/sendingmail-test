<?php
use PHPMailer\PHPMailer\PHPMailer;
require __DIR__."/vendor/autoload.php";

$success = array("status" => true);
$fail = array("status" => "fail");
if(empty($_POST)) {
    echo json_encode($fail);
    exit(0);
} else {
    if(array_key_exists('name', $_POST) && array_key_exists('email', $_POST) && array_key_exists('subject', $_POST) && array_key_exists('message', $_POST)) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
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