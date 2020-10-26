<?php
if (isset($_POST['Email'])) {

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "chris.rubiano42@gmail.com";
    $email_subject = "Contacto sitio web San José";

    function problem($error)
    {
        echo "Lo sentimos, pero hay algunos errores en el formulario que enviaste ";
        echo "Estos errores aparecen aquí abajo.<br><br>";
        echo $error . "<br><br>";
        echo "Por favor, corrige esos errores.<br><br>";
        die();
    }

    // validation expected data exists
    if (
        !isset($_POST['Name']) ||
        !isset($_POST['Email']) ||
        !isset($_POST['Message'])
    ) {
        problem('Lo sentimos, pero hay un error en el formulario que enviaste.');
    }

    $name = $_POST['Name']; // required
    $email = $_POST['Email']; // required
    $message = $_POST['Message']; // required

    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if (!preg_match($email_exp, $email)) {
        $error_message .= 'La dirección de correo electrónico que ingresaste no es válida.<br>';
    }

    $string_exp = "/^[A-Za-z .'-]+$/";

    if (!preg_match($string_exp, $name)) {
        $error_message .= 'El nombre que ingresaste no es válido.<br>';
    }

    if (strlen($message) < 2) {
        $error_message .= 'El mensaje que ingresaste no parece ser válido.<br>';
    }

    if (strlen($error_message) > 0) {
        problem($error_message);
    }

    $email_message = "Los detalles del formulario se encuentran debajo.\n\n";

    function clean_string($string)
    {
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message .= "Nombre: " . clean_string($name) . "\n";
    $email_message .= "Email: " . clean_string($email) . "\n";
    $email_message .= "Mensaje: " . clean_string($message) . "\n";

    // create email headers
    $headers = 'From: ' . $email . "\r\n" .
        'Reply-To: ' . $email . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    @mail($email_to, $email_subject, $email_message, $headers);
?>

    <!-- include your success message below -->

    Gracias por contactarnos. Nos pondremos en contacto de vuelta muy pronto.

<?php
}
?>