<?php
require_once '../vendor/autoload.php';  // Cargar el autoload de Composer

use Transbank\Webpay\WebpayPlus\Transaction;

if (isset($_GET['token_ws'])) {  // Webpay envía el token por POST
    $token = $_GET['token_ws'];

    try {
        // Confirmar la transacción
        $transaction = (new Transaction())->commit($token);

        if ($transaction->isApproved()) {
            echo "Pago exitoso. Orden: " . $transaction->getBuyOrder();
            // Aquí podrías redirigir a una página de éxito o guardar en la base de datos
        } else {
            echo "Pago fallido: " . $transaction->getStatus();
        }
    } catch (Exception $e) {
        echo "Error procesando el pago: " . $e->getMessage();
    }
} else {
    echo "No se recibió el token de Webpay.";
}
?>
