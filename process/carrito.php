<?php
//Mensaje de pregunta a Usuario para confirmar si desea seguir comprando o no

error_reporting(E_PARSE);
include '../library/configServer.php';
include '../library/consulSQL.php';
session_start();
$codigo=consultasSQL::clean_string($_POST['codigo']);
$cantidad=consultasSQL::clean_string($_POST['cantidad']);
if(empty($_SESSION['carro'][$codigo]))
{
	$_SESSION['carro'][$codigo] = array('producto' => $codigo, 'cantidad' => $cantidad);
    echo '<script>
         swal({
         title: "Producto agregado",
         type: "info",
         confirmButtonClass: "btn-danger",
         confirmButtonText: "success",
         confirmButtonText: "Seguir comprando", 
         closeOnConfirm: false,
         closeOnCancel: false
         },
         function(isConfirm) {
         if (isConfirm) {
           location.href="index.php";
         } else {
            location.href="index.php";
         }
         });
        </script>';
}else{
	echo '<script>
        swal({
        title: "ERROR",
        text: "El producto ya fue agregado al carrito",
        type: "error",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        cancelButtonClass: "btn-primary",
        confirmButtonText: "Seguir comprando",
        cancelButtonText: "Ver otro producto",
        closeOnConfirm: false
        },
        function(){
            window.location="index.php";
        });
    </script>';
}
