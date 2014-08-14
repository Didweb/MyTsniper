Slug
========

[Inicio Documentación][1]

Se encarga de cambiar ciertos tics pasados al texto, como por ejemplo crear enalces.

# Características

Se llama `formatostxt`.

Para llamarlo desde el controlador:

```

$sniper = $this->cargaSniper('formatostxt');


``` 

# Cómo se utiliza?

Un ejemplo de utilización de este servicio.

Si queremso transformar encalces y no queremos poner en el texto etiquetas HTML se puede hacer con estos tics: @EL ANCHOR@LA URL@ 

El metodo soporta 3 parametros:

**texto**: es el texto qeu se ha de analizar.
**clase**: Por si le queremos pasar algún nombre de clase para luego tratar en el css.
**destino**: Opcional por defecto es `_blank`.


```
		$texto = 'BLa bla bla bla @El buscadro Google@http://www.google.com@ ';

		$texto_limpio = $sniper->clase->links($texto,'mi_clase');

```

Este ejemplo devuelve el string (en HTML): `BLa bla bla bla <a href='http://www.google.com' class='mi_clase' target='_blank'>El buscadro Google</a> ` .




[1]: Inicio_Documentacion.md
