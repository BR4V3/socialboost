<?php
require_once 'vendor/autoload.php';  // Cargar el autoload de Composer

use Transbank\Webpay\WebpayPlus\Transaction;

// Prueba crear una transacción para verificar que el SDK funciona
try {
    $transaction = new Transaction();
    echo "SDK instalado correctamente. Clase Transaction cargada.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
