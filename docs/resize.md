Resize
========

[Inicio Documetación][1]

Este Sniper sirve para almacenar en carpetas y redimensionar imágenes.

# Características

El Sniper realiza las siguientes acciones:

- Se pueden configurar tantos tamaños como se quiera.
- Las imágenes se redimensionan o bine reducen y recortan, según se prefiera.
- Se puede controlar la calidad de la compresión.
- Evita que se sobrescriban archivos.
- Devuelve el nombre del archivo para almacenar en la base de datos.
- Permite los siguientes formatos: jpg, jepg, png y gif,


Se llama `resize`.

Para llamarlo desde el controlador:

```

$sniper = $this->cargaSniper('resize');


```

# Cómo se utiliza?

Un ejemplo de utilización de este servicio:

```

	$tmpname 		= $_FILES['imagen']['tmp_name'];
	$nombre_enviado = $_FILES['imagen']['name'];
	$save_name	= $_POST['nombre'];
	
	$patron = 'p1,75,50,50,1|p2,100,200,100,0|m,100,125,200,1';
	
	$sniper->clase->iniciamos('pruebas/fotos_pruebas',$patron);
		
	echo "Nombre para guardar = ".$sniper->clase->resizeImg($tmpname,$save_name,$nombre_enviado);


```



### Configuración

Se ha de configurar una cadena donde determinaremos el directorio donde guardara las imágenes del mismo tamaño, la calidad de compresión, Ancho imagen, el alto del imagen y si queremos que recorte o bien reduzca.

La cadena tendrá un aspecto similar a este: `p1,75,50,50,1|p2,100,200,100,0|m,100,125,200,1`

Con el símbolo `|` separamos los tamaños. 

Por ejemplo en este caso tenemos 3 tamaños se almacenaran en las carpetas p1, p2 y m . Estos directorios si no existen se crean de forma automática.

El primer tamaño nos dice:

Se almacena en el directorio p1.
Con una calidad de compresión 75 (la recomendada).
Un ancho de 50 pixels y alto de 50 pixels.
Donde indicamos el parámetro de corte en 1. 1= corta la imagen y 0= adapta la imagen.
En este caso la reducirá a 50 px de ancho y si el formato es más alto recortara la altura hasta alcanzar los 50px.

En el caso de que la opción de corte hubiera sido 0, la imagen se hubiera reducido hasta 50px de ancho manteniendo el formato original.



### Parámetros necesarios para la clase

Se ha de iniciar la clase con ...

```
	$tmpname 		= $_FILES['imagen']['tmp_name'];
	$nombre_enviado = $_FILES['imagen']['name'];
	$save_name	= $_POST['nombre'];
	
	$patron = 'p1,75,50,50,1|p2,100,200,100,0|m,100,125,200,1';
	$sniper->clase->iniciamos('pruebas/fotos_pruebas',$patron);

```

Donde: 

**'pruebas/fotos_pruebas'** Se refiere al directorio principal delas imágenes, dentro de este directorio se crearan los subdirectorios de los tamaños. En este caso si no existe el directorio `fotos_pruebas` este se crea de forma automática.
**$patron** Se refiere a la constante donde almacenaremos los tamaños y su configuración.


Luego llamamos al método que genera el resize....

```

echo "Nombre para guardar = ".$sniper->clase->resizeImg($tmpname,$save_name,$nombre_enviado);


```

Necesita los siguientes parámetros:

**$tmpname** : Es el archivo subido mediante $_FILES **$_FILES['imagen']['tmp_name']**.


**$save_name** : Es el nombre que se quiere del archivo, en nuestro caso lo mandamos en el formulario de subir archivo con un $_POST **$_POST['nombre']**.

**$nombre_enviado** : Es el nombre del archivo enviado por el sistema mediante $_FILES **$_FILES['imagen']['name']**.



En este ejemplo ejecuta los 3 tamaños y devuelve el nombre final del archivo para poder almacenar.

El nombre de archivo que devuelve no contiene el prefijo.

En los directorios se almacenaran de esta forma en este ejemplo:

Directorio: p1
--- Nombre de archivo: p1_NOMBRE.jpg 

Directorio: p2
--- Nombre de archivo: p2_NOMBRE.jpg 

Directorio: m
--- Nombre de archivo: m_NOMBRE.jpg 

Pero nos devuelve el nombre: NOMBRE.jpg luego en el controlador ya determinaremos que imagen queremos si la m_NOMBRE.jpg o la p1_NOMBRE.jpg


En caso de que el usuario volviera a subir otra imagen con el mismo nombre, para evitar sobreescribir el archivo el nombre se cambia  la siguiente forma:

Directorio: p1
--- Nombre de archivo: p1_NOMBRE.jpg 
--- Nombre de archivo: p1_1_NOMBRE.jpg 

Directorio: p2
--- Nombre de archivo: p2_1_NOMBRE.jpg 

Directorio: m
--- Nombre de archivo: m_1_NOMBRE.jpg 

Poniendo un prefijo con el numero de imagen, el método devuelve el nombre: 1_NOMBRE.jpg



[1]: Inicio_Documentacion.md
