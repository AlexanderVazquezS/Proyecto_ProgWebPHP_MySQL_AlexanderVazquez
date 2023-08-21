<?php


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require('vendor/autoload.php');
require_once('modelos/clientes.php');

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$objCliente = new clientes();
$filtro = array("email" => true);
$listaMailsClientes = $objCliente->mailCliente($filtro);

try {
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER; 
    $mail->isSMTP();
    $mail->Host       = 'mail.openmulita.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'clase@openmulita.com';
    $mail->Password   = 'Clase2253';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;


    //Recipients
    $mail->setFrom('clase@openmulita.com', 'Clase');
    $mail->addAddress('tbajos2@gmail.com', 'Joe User');     //Add a recipient
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'test cambio contraseña';

    $body =  '<cambie su contraseña>';  
    $mail->Body    =  $body;

    $mail->AltBody = 'Cambio de contraseña';

    $mail->send();
    echo 'Mensaje enviado correctamente';
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

    <div class="input-field col s6 offset-s3 center">
        <h5>Cambio de contraseña</h5>
    </div>

    <div class="row">
        <div class="input-field col s6 offset-s3">
            <i class="material-icons prefix green-text">mail</i>
            <input id="email" type="email" class="validate" value="<?= $objCliente->email ?>">
            <label for="email">Email</label>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="num_documento" type="text" class="validate" value="<?= $objCliente->num_documento ?>">
            <label for="num_documento">documento</label>
        </div>

        <div class="input-field col s6 offset-s3">
            <input id="password" type="password" class="validate">
            <label for="password">Password</label>
        </div>
        <div class="col s6 offset-s3">
            <button class="btn waves-effect waves-light blue lighten-2" type="submit" name="boton" value="editar">Ingresar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
