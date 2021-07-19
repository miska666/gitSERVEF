<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Procesa formulario de contacto </title>
    <link rel="stylesheet" href="../STYLES/style_php.css">
       
</head>
<body>
    <br />
    <br />

    <?php


    // FUNCIONES _____________________________________________________________________________________
        //funcion para validar campos obligatorios para rellenar con un mínimo de caracteres o una expresion regular

        function validarCampoObligatorio($dato, $minimoCaracteres)
        {
            if (!isset($dato) || strlen($dato) < $minimoCaracteres || preg_match('/^\s+$/', $dato)) {
                return false;
            } else {
                return true;
            }
        }

        //funcion para validar el correo como campo obligatorio con un mínimo de caracteres y una expresion regular de email

        function validarEmail($dato, $minimoCaracteres)
        {       
            if(isset($dato) && (strlen($dato) > $minimoCaracteres) && preg_match('/^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/i',$dato))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

     //_________________________________________________________________FIN DE LAS FUNCIONES _____________________________________



        if ($_POST['g-recaptcha-response'] == '') {
            echo "Captcha invalido";
        } 
        else {
            $obj = new stdClass();
            $obj->secret = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
            // $obj->secret = "6LcuSOMaAAAAAOb6LkZu0tj-QMo3m5aUVwXiuuhB";
            $obj->response = $_POST['g-recaptcha-response'];
            $obj->remoteip = $_SERVER['REMOTE_ADDR'];
            $url = 'https://www.google.com/recaptcha/api/siteverify';
        
            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($obj)
                )
            );
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
        
            $validar = json_decode($result);

            if($validar->success){

                //para avisar de cuales son los errores del formulario
                $swEsCorrecto=true;

                //para presentar los datos en una tabla
                printf("<table>") ;


                //en cada if comprobamos si los datos son correctos o no y se imprime en una tabla su valor si es correcto o "campo incorrecto" si no lo es
                if((isset($_POST['f_nombre']) && 
                validarCampoObligatorio($_POST['f_nombre'], 3) == true) )
                {
                    printf("<tr><th>Nombre</th><td>%s</td></tr>",$_POST['f_nombre']);
                }
                else{
                    printf("<tr><th>Nombre</th><td style='color:red'>Campo incorrecto</td></tr>");
                    $swEsCorrecto=false;
                }

                if((isset($_POST['f_email']) &&
                validarEmail($_POST['f_email'],9) == true) )
                {
                    printf("<tr> <th> Email  </th><td> " . $_POST['f_email'] . "</td> </tr>") ;
                }
                else{
                    printf("<tr><th>Email</th><td style='color:red'>Campo incorrecto</td></tr>");
                    $swEsCorrecto=false;
                }

                if(isset($_POST['conocido']) && $_POST['conocido']!="")
                {
                    printf("<tr> <th> Nos has conocido por:  </th><td> " . $_POST['conocido'] . "</td> </tr>") ;
                }
                else{
                    printf("<tr><th>Cómo nos has encontrado</th><td style='color:red'>Campo incorrecto</td></tr>");
                    $swEsCorrecto=false;
                }

                if((isset($_POST['f_mensaje']) && 
                validarCampoObligatorio($_POST['f_mensaje'],30) == true ) )
                {
                    printf("<tr> <th> Mensaje  </th><td> " . $_POST['f_mensaje'] . "</td> </tr>") ;
                }
                else{
                    printf("<tr><th>Mensaje</th><td style='color:red'>Campo incorrecto</td></tr>");
                    $swEsCorrecto=false;
                }

                if(isset($_POST['f_acepto']) && $_POST['f_acepto']!="")
                {
                    printf("<tr> <th> Condiciones  </th><td> " . $_POST['f_acepto'] . "</td> </tr>") ; 
                }
                else{
                    printf("<tr><th>Condiciones</th><td style='color:red'>Campo incorrecto</td></tr>");
                    $swEsCorrecto=false;
                }

                //para cerrar la tabla 
                printf("</table>");


                if($swEsCorrecto == true)
                {
                    printf("<h1>El formulario es correcto</h1>");
                    printf("<h1>¡¡¡ Gracias por enviarnos tus datos !!!</h1>");
                }
                else
                {
                    printf("<h1>Opss!!!, algo está mal, comprueba que dato te falta</h1>");
                }
            }
            else{
                echo "Captcha invalido";
            }
        }
        

    ?>

    <br />
<a href="../contacto.html">Volver al formulario de contacto</a>
</body>
</html>