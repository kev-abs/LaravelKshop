<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>K-SHOP | Recuperación de contraseña</title>

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
                    Recuperación segura de cuenta
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
                    Hemos recibido una solicitud para restablecer la contraseña asociada a tu cuenta en K-SHOP.
                    Como parte de nuestras medidas de protección y seguridad, necesitamos confirmar que esta solicitud fue realizada por el propietario legítimo de la cuenta.
                </p>


                <p style="
                    color: #495057;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 20px;
                ">
                    Para garantizar la confidencialidad de tu información y prevenir accesos no autorizados,
                    nuestro sistema ha generado el siguiente código de verificación único y temporal.
                    Este código es necesario para validar tu identidad y continuar de forma segura con el proceso de recuperación de contraseña.
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
                    Este código es personal, confidencial y válido únicamente para esta solicitud.
                    Te recomendamos utilizarlo lo antes posible para completar el proceso de recuperación.
                </p>


                <p style="
                    color: #212529;
                    font-size: 14px;
                    font-weight: bold;
                    margin-bottom: 15px;
                ">
                    Por tu seguridad, nunca compartas este código con nadie.
                    El equipo de K-SHOP nunca solicitará este código por correo, teléfono o cualquier otro medio.
                </p>


                <p style="
                    color: #495057;
                    font-size: 15px;
                    line-height: 1.6;
                    margin-bottom: 15px;
                ">
                    Si tú realizaste esta solicitud, puedes ingresar este código en el sistema para restablecer tu contraseña de forma segura.
                </p>


                <p style="
                    color: #6c757d;
                    font-size: 14px;
                    line-height: 1.6;
                    margin-bottom: 0;
                ">
                    Si no realizaste esta solicitud, puedes ignorar este mensaje.
                    Ningún cambio será realizado en tu cuenta sin la verificación correcta.
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