Correos
========

[Inicio Documentación][1]

Sniper para la verificación y preparación de datos a la hora de enviar datos por e-mail desde un formulario

# Características

Se llama `correos`.

Para llamarlo desde el controlador:

```

$sniper = $this->cargaSniper('correos');


``` 

# Cómo se utiliza?

Se utiliza en dos partes 1- en la zona de montaje de formulario. y 2- En el momento de validar los datos recibidos.

Se pasan los campos que formarán el formulario con algunos atributos, en formato array también el destino de envío.

Se obtienen los campos que formarán el formulario y se procede a montarlo.

Un ejemplo de utilización de este servicio.

###PASO 1:

```
		$losc = array('nombre|nom|texto|text','mensaje|men|texto|area','correo|cor|correo|text');
		$sniper->clase->inicio('aa',$losc);
		$correo = $sniper->clase->campos();
		

```

La variable en este caso `$loc` debe ser un array de lo contrario mostrara un error. Cada valor del array debe tener esta estructura....

En el ejemplo el primer valor es: `nombre|nom|texto|text` y representan...

NOMBRE_LABEL|NOMBRE_DEL_INPUT|TIPO_VERIFICACION|TIPO_DE_INPUT

Actualmente existe solo un tipo de verificación la llamada `correo` la cual hace una verificación de formato de correo de lo contrario devuelve un error, la verificación de tipo `texto` no hace nada.

Aún así todos los campos pasan un filtro para limpiar posibles etiquetas de HTML o PHP.


Ahora tenemos los campos montados  en la variable `$correo` y podemos montar el formulario así...

```

	echo "<form action='prueba_correo2.php' method='post'>"	;
	foreach ($correo as $nom=>$val){
		
		if($correo[$nom]['tipo']=='area'){
			echo "<br><label>".$correo[$nom]['nombre']."</label><textarea name=".$correo[$nom]['name']." ></textarea>";
			} else {
				
			echo "<br><label>".$correo[$nom]['nombre']."</label><input name=".$correo[$nom]['name']." type='text' >";	
				}
		
		
		
		}
	echo "<input type='hidden' value='".$sniper->clase->getDestino()."' > "	;	
	echo "<input type='submit' value='Mandar'>";	
	echo "</form>";	

```


###PASO 2:

Enviamos el formulario y en la pagina de recepción se realizan los chequeos de verificación y comprobación, si no son superados se almacena en una variable el error para luego nosotros mismos poder gestionar estos errores.

Tipos de verificaciones que se realizan:

- 1- Se verifica que los campos que llegan son los mismos que los que se configuraron en la variable anterior `$losc`.
- 2- Todos los campso son limpiados de etiquetas HTML o PHP.
- 3- Verifica si los campos tiene algún filtro especifico que pasar, en este ejemplo el filtro es el de `correo`



Para iniciar este proceso en la pagina 2 se ha de llamar de la siguiente forma ...

```

	$losc = array('nombre|nom|texto|text','mensaje|men|texto|area','correo|cor|correo|text');
	$sniper->clase->inicio('aa',$losc);
		
	$correo = $sniper->clase->check();

	if( $sniper->clase->MenErrorVer['errores']==1){
		echo "<br> Se ha producido un error -----------_> ERROR";
		} else {
		echo "<br> OK";
		print_r($correo);
		}


```

Con el método `check` se procesan las verificaciones y devuelve el resultado en variables para poder procesar el envío de formulario.

Las variables que devuelve son: 
`MenErrorVer` se trata de un array con varios valores los cuales son:

- $sniper->clase->MenErrorVer['errores'] = Si es 1 se ha producido algún tipo de error.
- $sniper->clase->MenErrorVer['correo']  = Si es 1 se ha producido un error al  verificar un correo y este ha resultado no tener un formato de e-mail correcto.
- $sniper->clase->MenErrorVer['errorVerificarCorreo'] = Deveuelve la cadena "Correo no Valido"
- $sniper->clase->MenErrorVer['errorVerificacion'] = Deveuelve la cadena "Se han producido errores"
- $sniper->clase->MenErrorVer['errorDatos'] = Deveuelve la cadena "Error en los datos, falta Destion o Tipos de verificación"
- $sniper->clase->MenErrorVer['errorDatos2'] = Los datos de verificación deben venir en forma de ARRAY"

Se pueden mostrar todos el array de errores con el método: `$sniper->clase->mostrarErrores();`

`$correo` en este caso almacena en un array los valores y su nombre para procesar en el envío de mails.

De esta forma podemos sacar estos valores: 

- $correo['name'] = Equivale al nombre del input.
- $correo['dato'] = Equivale al valor del input enviado y procesado.
 


[1]: Inicio_Documentacion.md
