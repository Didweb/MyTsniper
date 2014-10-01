ArrayOrder
========

[Inicio Documentación][1]

Este pequeño Sniper para reordenar arrays multidimensionales y otros métodos relacionados con ordenar arrays de cualquier forma que necesite.

# Características

Se llama `arrayorder`.

Para llamarlo desde el controlador:

```

$sniper = $this->cargaSniper('arrayorder');


``` 

# Cómo se utiliza?

Existen diferentes métodos para diferentes funcionalidades por el momento existen...

- Método **array_orderby**. Ordenar arrays multidimensionales por un campo o más y determinar el orden ASC o bien DESC.
- Método **shuffle_assoc**. Ordenar aleatorio para arrays multidimensionales y asociativos.
- Método **elimina_duplicados**. Elimina duplicados concretando un campo.

## Método array_orderby()


Para llamar a este método 

```
        $sniper = $this->cargaSniper('arrayorder');
	$resultado = $sniper->clase->array_orderby($nube, 'contador', SORT_DESC);

```

Dentro de resultado obtendremos un array ordenado de forma DESC por el campo 'contador' en el array multidimensional llamado $nube.

El aspecto del array original debe ser similar a esto:ç

```
$matriz[0] = array(	'campo1' => 1,
					'campo2' => 9,
					'campo3' => 3
					);

$matriz[1] = array(	'campo1' => 5,
					'campo2' => 1,
					'campo3' => 9
					);

```

Y para ordenarlo por ejemplo: por el campo `campo2` de forma ASC...

```
	$sniper = $this->cargaSniper('arrayorder');
	$resultado = $sniper->clase->array_orderby($matriz, 'campo2', SORT_ASC);

```

el resultado sera...


```
$matriz[1] = array(	'campo1' => 5,
					'campo2' => 1,
					'campo3' => 9
					);

$matriz[0] = array(	'campo1' => 1,
					'campo2' => 9,
					'campo3' => 3
					);
```


## Método shuffle_assoc

Para llamar a este método aremos...

```
	$sniper = $this->cargaSniper('arrayorder');
	$resultado = $sniper->clase->shuffle_assoc($matriz);
```

Se obtiene dentro de `resultado` el array que pasemos pero de forma aleatoria.



## Modo elimina_duplicados

Para llamar a este método ...

```
	$sniper = $this->cargaSniper('arrayorder');
	$resultado = $sniper->clase->elimina_duplicados($matriz,$campo);

```

Donde el parámetro `matriz` es para determinar en que array actuar y el `campo` cual es el campo que no puede tener duplicados y servirá de criterio para eliminar valores del array.

[1]: Inicio_Documentacion.md
