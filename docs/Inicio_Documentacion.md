MyTSniper
=========

Es mi coleccion de pequeños códigos que necesito par adiferentes y variadas funcionalidades.

Esta creado para mi Framework / MVC personal llamado MyT.

# Funcionamiento

Mis controladores en [MyT][1] tiene extendida una clase llamada `Controlador` con la cual me apoyo para ir trayendo las calses necesarias para diferentes funcionalidades que necesite dentro del controlador.

En la clase `Controlador` tengo un método que me trae el `Sniper` que necesite, este método tiene este aspecto:

```
public function cargaSniper($sniper)
	{
		$this->sniper = new mySniper();
		$this->sniper->__autoload($sniper);	
		
		return $this->sniper;
		
	}

```

Dentro de mi Controlador puedo solictar cualquier servicio, haciendo una solicitud d ela siguiente forma:

```
		$texto = "Cambia esto %1 y esto %2 y esto %3"
		$sniper = $this->cargaSniper('mapeatxt');
		$texto_final = $sniper->clase->mapeatxt($texto,'xxx','yyy','zzz');
		echo $texto_final;

```

En este caso he llamado a un Sniper llamado `mapeatxt` que lo utilizo para pasar como parametros dentro de un string.

El anterior ejemplo devuelve la siguiente cadena: `Cambia esto xxx y esto yyy y esto zzz`.

Resuminedo se utiliza `$this->cargaSniper('NOMBRE_DEL_SNIPER')` para solicitar un servicio y luego se ejecuta los metodos necesarios dependiendo de la manera de funcionar de cada Sniper.

Para llamar a un metodo seria: `$sniper->clase->NOMBRE_METODO(PARAMETROS)`.


# Listado de Snipers

- [Mapeatxt][2] : Sirve para pasar parametros a un string.
- [Paginador][3] : Sirve para crear las paginaciones de los listados.
- [Resize][4] : Almacena y redimensiona imágenes (jpg,jepg, png y gif).
- [Slug][5] : Creador de Slugs par alas urls y limpieza de cadenas.
- [ArrayOrder][6] : Ordenar array asociativos, multidimensionales, de forma aleatoria, por un campo en ASC / DESC, etc.
- [Ale][7] : Crea cadenas de números y letras aleatoriamente.
- [esRobot][8] : Comprueba si una visita es un robot o un usario.

[1]: https://github.com/Didweb/MyT
[2]: mapeatxt.md
[3]: paginador.md
[4]: resize.md
[5]: slug.md
[6]: arrayorder.md
[7]: ale.md
[8]: esrobot.md
