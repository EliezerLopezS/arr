<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
</head>

<body>
    <?php
        // Variables para los valores de "nombre", "apellidos" y "domicilio"
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];
        

        // Variables para la fecha y hora actuales
        $fecha = date("d/m/Y");
        $hora = date("H:i:s");

        // Constantes de los precios
        define("precio1", 1.75);
        define("precio2", 1.05);

        // Vector de variables para almacenar el precio de cada producto
        $totalProducto = array();

        // Abre el archivo numerofactura.txt 
        $leerNumeroFactura = fopen("numerofactura.txt", "rb");

        // Variable $factura para leer el contenido de "leerNumeroFactura"
        

        //Cierra el archivo
        fclose($leerNumeroFactura);

     

        // Abrimos el archivo otra vez
        $leerNumeroFactura = fopen("numerofactura.txt", "wb");

        // Escribimos el valor de la variable "$factura" para la próxima
        fwrite($leerNumeroFactura, $factura);

        // Cierra el archivo
        fclose($leerNumeroFactura);

        // Cuerpo de la factura simplificada
        if (isset($_REQUEST["producto1"])) {
            $producto1 = $_REQUEST["producto1"];
            $cantidad1 = $_REQUEST["cantidad1"];
            $totalProducto[0] = precio1 * $cantidad1;
        } else {
            $producto1 = "Producto no seleccionado";
            $cantidad1 = 0;
            $totalProducto[0] = 0;
        }

        if (isset($_REQUEST["producto2"])) {
            $producto2 = $_REQUEST["producto2"];
            $cantidad2 = $_REQUEST["cantidad2"];
            $totalProducto[1] = precio2 * $cantidad2;
        } else {
            $producto2 = "Producto no seleccionado";
            $cantidad2 = 0;
            $totalProducto[1] = 0;
        }

        // Pie de la factura simplificada
        $total = 0;
        for ($i = 0; $i < count($totalProducto); $i++) {
            $total += $totalProducto[$i];
        }

        $IVA = $total * 0.04;
        $subtotal = $total - $IVA;

        $datos = fopen("datos.txt", "ab");
    
        // Escribe los datos introducidos separados por ";"
        fwrite($datos, $factura.";".$fecha.";".$hora.";".$nombre.";".$apellidos.";".$domicilio.";".$producto1.";".$cantidad1.";".$totalProducto[0].";".$producto2.";".$cantidad2.";".$totalProducto[1].";".$subtotal.";".$IVA.";".$total."\n");

        fclose($datos);
        ?>
</body>
</html>