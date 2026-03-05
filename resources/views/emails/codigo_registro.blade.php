<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>K-SHOP | Verificación de cuenta</title>

</head>


<body style="
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    font-family: Arial, Helvetica, sans-serif;
">


    <div style="
        width: 100%;
        padding: 40px 0;
        background-color: #f8f9fa;
    ">


        <div style="
            max-width: 520px;
            margin: auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        ">


            <!-- HEADER estilo Bootstrap dark -->
            <div style="
                background-color: #212529;
                padding: 30px;
                text-align: center;
            ">

                <img
                    src="http://localhost/img/logo_kshopsinfondo.png"
                    width="70"
                    style="margin-bottom: 10px;"
                >

                <h2 style="
                    color: #ffffff;
                    margin: 0;
                    font-weight: bold;
                ">
                    K-SHOP
                </h2>

                <p style="
                    color: #ced4da;
                    margin-top: 5px;
                    font-size: 14px;
                ">
                    Verificación segura de registro
                </p>

            </div>


            <!-- BODY -->
            <div style="
                padding: 35px;
                color: #212529;
            ">


                <!-- SALUDO CON NOMBRE -->
                <h4 style="
                    margin-top: 0;
                    margin-bottom: 15px;
                    font-weight: bold;
                ">
                    Hola, {{ $nombre }}
                </h4>


                <p style="
                    color: #495057;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 20px;
                ">
                    Te damos la bienvenida a K-SHOP.
                    Hemos recibido una solicitud para crear una cuenta asociada a este correo electrónico.
                    Como parte de nuestro compromiso con la seguridad y protección de datos,
                    necesitamos confirmar que eres el propietario legítimo de esta dirección.
                </p>


                <p style="
                    color: #495057;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 20px;
                ">
                    Para completar el proceso de registro y activar tu cuenta de forma segura,
                    nuestro sistema ha generado el siguiente código de verificación único y temporal.
                    Este código valida tu identidad y permite finalizar correctamente la creación de tu cuenta.
                </p>



                <!-- CODIGO -->
                <div style="
                    text-align: center;
                    margin: 30px 0;
                ">

                    <div style="
                        display: inline-block;
                        background-color: #212529;
                        color: #ffffff;
                        font-size: 32px;
                        letter-spacing: 8px;
                        padding: 15px 35px;
                        border-radius: 10px;
                        font-weight: bold;
                    ">

                        {{ $codigo }}

                    </div>

                </div>



                <p style="
                    color: #495057;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 15px;
                ">
                    Este código es personal, confidencial y tiene una validez limitada de 2 minutos.
                    Te recomendamos ingresarlo lo antes posible para activar tu cuenta sin inconvenientes.
                </p>


                <p style="
                    color: #212529;
                    font-size: 14px;
                    font-weight: bold;
                    margin-bottom: 15px;
                ">
                    Por tu seguridad, nunca compartas este código con terceros.
                    El equipo de K-SHOP jamás solicitará este código por teléfono, correo o mensajes externos.
                </p>


                <p style="
                    color: #495057;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 15px;
                ">
                    Una vez verificado el código, tu cuenta quedará activada y podrás iniciar sesión
                    para acceder a tus pedidos, historial y beneficios exclusivos.
                </p>


                <p style="
                    color: #6c757d;
                    font-size: 14px;
                    line-height: 1.6;
                    margin-bottom: 0;
                ">
                    Si no realizaste esta solicitud de registro,
                    puedes ignorar este mensaje.
                    No se activará ninguna cuenta sin la verificación correspondiente.
                    Nuestro sistema continúa protegiendo tu información en todo momento.
                </p>


            </div>



            <!-- FOOTER estilo Bootstrap dark -->
            <div style="
                background-color: #212529;
                padding: 18px;
                text-align: center;
                color: #ced4da;
                font-size: 13px;
            ">

                © {{ date('Y') }} K-SHOP
                Sistema de información seguro

            </div>


        </div>


    </div>


</body>

</html>