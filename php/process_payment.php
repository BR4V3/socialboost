<?php
require_once '../vendor/autoload.php';  // Ajusta la ruta a autoload.php si es necesario

use Transbank\Webpay\WebpayPlus\Transaction;  // Asegúrate de importar la clase Transaction correctamente

// Iniciar sesión
session_start();  // Esto asegura que se gestione correctamente la sesión del usuario

// Configuración del comercio para pruebas (en producción usa configureForProduction)
\Transbank\Webpay\WebpayPlus::configureForIntegration('597055555532', '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C');

// Datos de la transacción
$buyOrder = rand();  // Número único de la orden de compra
$sessionId = session_id();  // ID de sesión del usuario
$amount = 25000;  // Monto de la compra en pesos chilenos (ajústalo según el curso seleccionado)
$returnUrl = "http://localhost/socialboost/php/return.php";  // URL a la que Webpay redirigirá después del pago

try {
    // Crear la transacción
    $transaction = (new Transaction())->create($buyOrder, $sessionId, $amount, $returnUrl);

    // Redirigir al usuario a Webpay
    header('Location: ' . $transaction->getUrl() . '?token_ws=' . $transaction->getToken());
    exit();
} catch (Exception $e) {
    echo 'Error iniciando la transacción: ' . $e->getMessage();
}
?>
