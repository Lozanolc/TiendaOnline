<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <?php include './inc/link.php'; ?>
</head>
<style>
        #DP{
            padding-left: 200px;
           }
       #DC{
            padding-left: 150px;
           }
       #registro{
           background-color: #2268ff2e;
            border-radius: 2%;
            border: none;
        }      
</style>
<body id="container-page-registration">
    <?php include './inc/navbar.php'; ?>
    <section id="form-registration">
        <div class="container" id=registro>
            <div class="page-header">
              <h1 style="text-align: center;"><b><i>Registro de Usuario</b></i></h1>
            </div>
            <div class="row">
                <div class="col-sm-5 text-center">
                    <figure>
                      <br>
                      <br>
                      <br>
                      <br>
                      <img src="./assets/img/MArilexys.png" alt="store" class="img-responsive">
                    </figure>
                </div>
                <div class="col-sm-7">
                    <div id="container-form">
                       <form class="FormCatElec" action="process/regclien.php" role="form" method="POST" data-form="save">
                          <div class="container-fluid">
                            <div class="row">
                              <div class="col-xs-12">
                                <legend id="DP"><i class="fa fa-user"></i> &nbsp; Datos personales</legend>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-address-card-o" aria-hidden="true"></i><b>&nbsp; Ingrese número de Cedula</b></label>
                                  <input class="form-control" type="num" required name="clien-nit" pattern="[0-9]{1,15}" title=" Ingrese solo numeros" maxlength="15" >
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label" ><i class="fa fa-user"></i><b>&nbsp; Ingrese Nombres</b></label>
                                  <input class="form-control" type="text" required name="clien-fullname" title="Ingrese un nombre Valido" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-user"></i><b>&nbsp; Ingrese Apellidos</b></label>
                                  <input class="form-control" type="text" required name="clien-lastname" title="Ingrese un apellido Valido" pattern="[a-zA-Z ]{1,50}" maxlength="50">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-mobile"></i><b>&nbsp;Ingrese número telefónico</b></label>
                                    <input class="form-control" type="tel" required name="clien-phone" maxlength="15" title="Ingrese su número telefónico">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-envelope-o" aria-hidden="true"></i>&nbsp;<b> Ingrese correo</b></label>
                                    <input class="form-control" type="email" required name="clien-email" title="Ingrese la dirección de su Email" maxlength="50">
                                </div>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-home"></i>&nbsp;<b> Ingrese dirección de habitación</b></label>
                                  <input class="form-control" type="text" required name="clien-dir" title="Ingrese la direción en la reside actualmente" maxlength="100">
                                  <br>
                                  <br>
                                </div>
                              </div>
                             
                              <div class="col-xs-12">
                                <legend id="DC"><i class="fa fa-lock"></i><b> &nbsp; Datos para ingresar a la pagina</b></legend>
                              </div>
                              <div class="col-xs-12">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-user-circle-o" aria-hidden="true"></i><b>&nbsp; Ingrese nombre de usuario</b></label>
                                    <input class="form-control" type="text" required name="clien-name" title="Ingrese su nombre. Máximo 9 caracteres (solamente letras y numeros sin espacios)" pattern="[a-zA-Z0-9]{1,9}" maxlength="9">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                  <label class="control-label"><i class="fa fa-lock"></i><b>&nbsp; Introduzca una contraseña</b></label>
                                  <input class="form-control" type="password" required name="clien-pass" title="Defina una contraseña para iniciar sesión">
                                </div>
                              </div>
                              <div class="col-xs-12 col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label"><i class="fa fa-lock"></i>&nbsp;<b> Repita la contraseña</b></label>
                                    <input class="form-control" type="password" required name="clien-pass2" title="Repita la contraseña">
                                </div>
                              </div>
                            </div>
                          </div>
                          <p><button type="submit" class="btn btn-primary btn-block btn-raised">Registrarse</button></p>
                        </form> 
                    </div> 
                </div>
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>
</html>