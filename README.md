# PRE REQUISITOS

- Tener instalado un programa de entorno de desarrollo como Laragon (recomendado) ó XAMPP
- Tener un manejador de bases de datos como MySQL workbench, phpMyAdmin ó DBeaver
- Instalar Composer
- Tener una consola capaz de trabajar con comandos git

## AJUSTE ARCHIVO DE HOSTS

*En el caso de utilizar Laragon esto se hace de forma automatica *

Es necesario realizar las configuraciones DNS en el host local para el correcto mapeo de los nombres DNS con los virtualhost configurados.

Para esto es necesario agregar las siguientes entradas en el archivo:

C:\Windows\System32\drivers\etc\hosts (Windows).

/etc/hosts (linux / Mac , requiere sudo para su edición).

Mover la carpeta host al escritorio, darle a "continuar" y abrirlo con bloc de notas para poder agregar lo siguente:

```
127.0.0.1	Recetas.test
```

## PASOS PARA CORRER EL PROYECTO EN LOCAL



### Proyecto PORTAL-LARAVEL
0- Iniciamos los servicios de Laragon ó los de XAMPP

1- Dentro del repositorio del proyecto en Github accedemos al botón verde que dice "Code" y copiamos la URL de HTTPS

2- En la terminar nos dirigimos a la siguiente ruta C:\laragon\www ó C:\xampp\htdocs 

3- Escribimos lo siguiente: git clone https://github.com/PedrodeRobles/Recetas.git

4- Despues accedemos al proyecto en la terminal: cd Recetas\

5- Escribir: composer install

6- Escribir: composer update

7- Abrir el proyecto en el editor de código

8- Copiar el archivo .env.example, pegarlo a la misma altura y renombrarlo a .env

9- Abrimos el .env y en esta sección declaramos el nombre de la base de datos, el usuario y el password
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=recetas
DB_USERNAME=root
DB_PASSWORD=

10- En el manejador de bases de datos creamos la conección con los mismos datos que estan en el paso anterior

11- Volvemos a la terminal y corremos el siguiente comando: php artisan migrate
*En este paso migramos las tablas y sus columnas al manejador de bases de datos

12- Corremos el siguente comando: php artisan key:generate

13- Escribimos: php artisan storage:link

14- Escribimos: npm install

15- Ahora: npm run dev
*Este comando debe permancer activo para poder ejecutar los cambios que se vayan haciendo en el proyecto

16- Vamos al navegador y nos dirigimos a recetas.test
En el caso de que aparezca en blanco podemos hacer lo siguiente:
 . Abrimos otra terminal con la ruta del proyecto
 . Correr el comando: php artisan serve 
 . Copiar la url en el navegador. Ejemplo: http://127.0.0.1:8000
 *Matener este comando activo si queremos seguir manipulando y visualizando el proyecto en el navegador


### ERRORES

- Si al correr el comando composer update ó composer install aparece un error comprobar que la version de php sea ^8.0.2|^8.1
para saber la version que estamos utilizando podemos correr el comando: php -v

- Si el npm install no funciona verificar que la version sea la 8.18 por lo menos. Para ver la versión podemos correro el comando: npm -v

- Si no se migran las tablas debemos verificar que los datos sean identicos a los que declaramos en el archivo .env
DB_DATABASE=recetas
DB_USERNAME=root
DB_PASSWORD=

Nombre de la base de datos: recetas
username: root
password:
```
