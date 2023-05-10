# Daily Trends

Página web que recoge los artículos de varios periódicos digitales como son:
- As
- El Mundo
- El País
- Levante
- Marca
- Valencia Plaza
Además de brindar al usuario el poder de modificar el contenido de los artículos recogidos en los mencionados medios digitales, e incluso crear artículos propios.

## Instalación
Para poder lanzar esta aplicación es necesario disponer de al menos:
- PHP 8
- Node 18.14

Para instalarlo se deben de lanzar distintos comandos:
```
git clone https://github.com/OrxataGuy/DailyTrends
cd DailyTrends 

cp .env.example .env // Se deberá añadir información sobre la base de datos
composer install // Instala dependencias de PHP
php artisan key:generate // Genera una key única para la aplicación
npm install // Instala dependencias de node

php artisan migrate // Crea las tablas de la aplicación en la base de datos introducida en el archivo .env
php artisan db:seed // Crea los distintos publishers que utilizará la aplicación

php artisan serve // Lanza la aplicación
```

Una vez lanzado todo esto, cuando se ejecute el último comando, la aplicación será accesible desde `http://localhost:8000`.

## Comandos
Dado que la carga de noticias puede ser un poco tediosa al usuario, las noticias generalmente se cargan cada hora a través de un comando llamado `load:feed`,  el cual se puede lanzar de dos modos:
- A través de un cron configurado para lanzarse cada hora, lanzando `php artisan load:feed`
- A través de un cron que delegue el lanzamiento a la aplicación, lanzando `php artisan schedule:run` (Recomendado)
Una vez se lance el comando, la aplicación se encargará de recoger los artículos nuevos de cada una de los medios que se encuentren habilitados por el usuario. Cuantos más medios de comunicación haya habilitados, más noticias cargará la aplicación. 

## Funcionamiento
Los medios son habilitables para el usuario a través de de un listado de medios que aparece en todo momento en la aplicación en la parte superior de la pantalla. Al hacer click sobre un medio deshabilitado, automáticamente este cargará los artículos del medio y la página se recargará. Una vez habilitado, puede deshabilitarse y a la próxima vez que se habilite el mismo día, si la aplicación detecta que ya ha cargado los artículos de ese medio, prescindirá de volver a cargarlos.

A través de una navegación intuitiva, se puede navegar entre los distintos feeds de cada uno de los medios, existiendo una página principal que recoge algunos de los feeds de hoy, y dando al usuario la posibilidad de ir a un feed en concreto si lo desea.

Al borrar un artículo, este no se borrará, sino que se marcará como eliminado. Esto permite que cuando un usuario borra un artículo, este no vuelva a aparecer, ya que de no ser así la aplicación volvería a intentar cargarlo, siempre que sea del mismo día.

Cuando se cargan artículos nuevos, siempre se eliminan los artículos que llevan en la aplicación más de un día (tanto los cargados como los creados), esto se hace con el fín de mantener el control de los artículos que hay en la base de datos y evitar un sobrepoblamiento en cuestión de días.

<!-- img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads" -->
