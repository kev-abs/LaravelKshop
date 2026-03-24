<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Bienvenido a K-SHOP</title>
</head>
<body style="margin:0; padding:0; font-family:Arial, sans-serif; background:#f5f5f5;">

  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">

        <!-- CONTENEDOR -->
        <table width="600" style="background:#ffffff; margin-top:20px; border-radius:10px; overflow:hidden;">

          <!-- HEADER -->
          <tr>
            <td style="background:black; color:white; text-align:center; padding:20px;">
              <h1 style="margin:0;">K-SHOP</h1>
              <p style="margin:5px 0 0;">Streetwear & Estilo Urbano</p>
            </td>
          </tr>

          <!-- HERO IMAGE -->
          <tr>
            <td>
              <img src="http://35.175.5.116:8080/uploads/productos/logo_kshopsinfondo.png" 
                   alt="KSHOP" 
                   style="width:100%; height:auto;">
            </td>
          </tr>

          <!-- CONTENIDO -->
          <tr>
            <td style="padding:30px; text-align:center;">

              <h2 style="margin-bottom:10px;"> ¡Bienvenido a K-SHOP!</h2>

              <p style="color:#555;">
                Gracias por unirte a nuestra comunidad.<br>
                Prepárate para recibir ofertas exclusivas y lo último en moda urbana.
              </p>

              <!-- BOTON -->
              <a href="http://tudominio.com"
                 style="display:inline-block; margin-top:20px; padding:12px 25px; background:#ffc107; color:black; text-decoration:none; border-radius:30px; font-weight:bold;">
                 Explorar colección
              </a>

            </td>
          </tr>

          <!-- PRODUCTOS -->
          <tr>
            <td style="padding:20px;">
              <h3 style="text-align:center;"> Recomendados</h3>

              <table width="100%">
                <tr>

                  @foreach($productos as $p)
                  <td style="width:33%; text-align:center; padding:10px;">
                    <img src="http://35.175.5.116:8080/uploads/productos/{{ $p->Imagen }}"
                         style="width:100%; border-radius:10px;">
                    <p style="font-size:14px;">{{ $p->Nombre }}</p>
                  </td>
                  @endforeach

                </tr>
              </table>
            </td>
          </tr>

          <!-- FOOTER -->
          <tr>
            <td style="background:#f1f1f1; text-align:center; padding:15px; font-size:12px; color:#777;">
              © 2026 K-SHOP - Todos los derechos reservados
            </td>
          </tr>

        </table>

      </td>
    </tr>
  </table>

</body>
</html>