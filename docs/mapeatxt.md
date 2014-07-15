Mapeatxt
========

[Inicio Docuemtacion][1]

Este Sniper sirve para pasar parámetros a una cadena de texto, para cuando una cadena de texto situada en mis diccionarios `locale`, tiene ciertos parámetros que se crean en el controlador.

Entonces utilizo este Sniper para pasarle los parámetros.

# Características

Se llama `mapeatxt`.

Para llamarlo desde el controlador:

```

$sniper = $this->cargaSniper('mapeatxt');


```

# Cómo se utiliza?

Un ejemplo de utilización de este servicio:

```
		$texto = "Cambia esto %1 y esto %2 y esto %3"
		$sniper = $this->cargaSniper('mapeatxt');
		$texto_final = $sniper->clase->mapeatxt($texto,'xxx','yyy','zzz');
		echo $texto_final;

```

Este ejemplo devuelve el string: `Cambia esto xxx y esto yyy y esto zzz` .

[1]: Inicio_Documentacion.md
