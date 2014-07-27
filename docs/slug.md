Slug
========

[Inicio Documentación][1]

Este pequeño Sniper se encarga de crear slugs para las urls o cualquier limpieza de texto.

# Características

Se llama `slug`.

Para llamarlo desde el controlador:

```

$sniper = $this->cargaSniper('slug');


``` 

# Cómo se utiliza?

Un ejemplo de utilización de este servicio:

```
		$texto = 'Texto de ejemplo: Á è ñ P % --o Wç ';

		$texto_limpio = $sniper->clase->limpiando($texto);

```

Este ejemplo devuelve el string: `texto-de-ejemplo-a-e-n-p-o-wc` .



# Opciones

Por defecto los espacios en blanco los cambia por guión medio `-`, pero se puede especificar el caracter a remplazar por los espacios en blanco de esta forma:

```
		$texto = 'Texto de ejemplo: Á è ñ P % --o Wç ';

		$texto_limpio = $sniper->clase->limpiando($texto,'_');

```

en este caso el resultado sera: `texto_de_ejemplo_a_e_n_p_o_wc_`


[1]: Inicio_Documentacion.md
