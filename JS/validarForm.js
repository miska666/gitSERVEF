     
        //  función para validar texto y un minimo de caracteres
         
         function validarCampoObligatorio(dato, minimoCaracteres)
         {   
                               
             if(dato.length < minimoCaracteres || /^\s+$/.test(dato))
             {
                 return false;   
             }
             else
             {
                 return true;
             }
         } 
 
        //  funcion para dar aviso de que el campo nombre no está completo o correcto

         function muestraValidacionNombre()
         {
             var nombre = document.getElementById("f_nombre").value;
             if(validarCampoObligatorio(nombre, 3))
             {
                document.getElementById("incompleto_nombre").innerHTML="";
             }
             else
             {
                 document.getElementById("incompleto_nombre").innerHTML="(*)Campo obligatorio vacío";
             }
 
         };

        //  función para comprobar que el correo tiene un mínimo y coincide con una expresión regular q comprueba q sea un email

         function validarEmail(dato, minimoCaracteres)
         {            
             if(dato.length > minimoCaracteres && /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,4})+$/i.test(dato))
             {
                 return true;
             }
             else
             {
                 return false;
             }
 
         }

         //  funcion para dar aviso de que el campo email no está completo o correcto
 
         function muestraValidacionEmail()
         {
             var email = document.getElementById("f_email").value;
             if(validarEmail(email, 6))
             {
                document.getElementById("incompleto_email").innerHTML="";
             }
             else
             {
                 document.getElementById("incompleto_email").innerHTML="El correo electrónico es incorrecto";
             }
 
         }

        //  funcion que recorre los radiobuttons para comprobar si hay alguno marcado

         function validarRadiobuttons(listaRadioButtons)
        {
            var marcado=false;

            for(var i=0; i< listaRadioButtons.length; i++)
            {
                if(listaRadioButtons[i].checked == true)
                {
                    marcado = true;
                    break;
                }
            }
            
            if(marcado == true)
            {
                return true;
            }
            else
            {
                return false;
            }

        }

        // funcion para dar aviso de que el campo radiobutton no está completo o correcto

        function muestraValidacionRadiobutton()
        {
            var radiobuttons = document.getElementsByName("conocido");
            if(validarRadiobuttons(radiobuttons) == true)
            {
                document.getElementById("incompleto_radio").innerHTML="";
            }
            else
            {
                document.getElementById("incompleto_radio").innerHTML="(*) Error. Debe estar marcada una de las opciones propuestas";
            }

        }

        // funcion para dar aviso de que el campo mensaje no está completo o correcto

        function muestraValidacionMensaje()
        {
            var nombre = document.getElementById("f_mensaje").value;
            if(validarCampoObligatorio(nombre, 30))
            {
                document.getElementById("incompleto_mensaje").innerHTML="";
            }
            else
            {
                document.getElementById("incompleto_mensaje").innerHTML="(*)Campo obligatorio, el mensaje tiene que tener al menos 30 caracteres";
            }

        }


        //  funcion que recorre los radiobuttons para comprobar si hay alguno marcado

        function validarCheckbox(listaDeCheckboxes, numeroMinimo)
        {
            var marcados = 0;
            for(var i=0; i< listaDeCheckboxes.length; i++)
            {
                if(listaDeCheckboxes[i].checked == true)
                {
                    marcados++;
                }
            }
            if(marcados >= numeroMinimo)
            {
                return true;
            }
            else
            {
                return false;
            }

        }

        // funcion para dar aviso de que el campo Aceptar condiciones no está completo o correcto

        function muestraValidacionAceptarCondiciones()
        {
            var checkBoxes = document.getElementsByName("f_acepto");
            
            if(validarCheckbox(checkBoxes,1) == true)
            {
                document.getElementById("incompleto_acepto").innerHTML="";
            }
            else
            {
                document.getElementById("incompleto_acepto").innerHTML = "(*) Debes aceptar las condiciones";
            }

        }
