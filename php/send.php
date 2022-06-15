<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

function response($msg, $status, $code, $error){
  $res=[
    "msg" => $msg,
    "status" => $status,
    "code" => $code,
    "error" => $error
  ];
  print_r(json_encode($res));
}

$name = $_POST['name'];
// $surname = "username";
//$phone = "0000";
$email = $_POST['email'];
$msg = $_POST['msg'];
$emailTo = $_POST['emailTo'];

if(!empty($name) || !empty($email) || !empty($msg)){
  $email_saliente_nombre = $name;
  $email_saliente = $email;
  $subject = "Contact Form agaveazul.com";
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= "From: {$name} <{$email}>\r\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente
  $headers .= "Reply-To: {$email}\r\n";
  $message = "
    <html>
    <head>
    <title>HTML</title>
    </head>
    <body>
    Name: <b>{$name}</b> <br><br>
    Email: <b>{$email}</b> <br><br>
    Message: <b>{$msg}</b> <br><br>
    </body>
    </html>";

  if (mail($emailTo, $subject, $message, $headers)) {
    response('Form sent successfully. We will contact you shortly', "ok", 200, null);
  } else {
    response('An error occurred. Please try again late', "error", 400, true);
  };
}else {
  response('Incomplete data. Please check and try again', "error", 400, true);
}

?>
