EsRobot
========

[Inicio Documentación][1]

Para saber si un usuario es un robot o no.

# Características

Se llama `esrobot`.

Para llamarlo desde el controlador:

```

$sniper = $this->cargaSniper('esrobot');


``` 

# Cómo se utiliza?

Se ha de activar el método `esRobot` y pasarle 2 parámetros el `$_SERVER['HTTP_USER_AGENT']` y por otro lado la ruta donde tenemos el listado de los robots.

```
$sniper = $this->cargaSniper('esrobot');
$esUnRobot = $sniper->clase->esRobot($_SERVER['HTTP_USER_AGENT'], 'src/Documentos/LiRobots.txt');

```


[1]: Inicio_Documentacion.md
