<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## Wimander backend (API) con Laravel

Backend de wimander para persistir la acion

## Requesitos

- Tener instalado PHP

- Tener instalado MYSQL

- Tener instalado Composer

- Tener Instalado Laravel 10+

De contar con los requisitos siga con las intrucciones para montar el servidor

## Intrucciones

- Ejecute `composer install ` para instalar las dependencias en el proyecto

- Cree un archivo ***.env*** en la raíz, siguiendo el ejemplo de ***.env.example***

- Cree una base de datos llamada ***wimander_api***

- Ejecuta el comando ` php artisan key:generate ` para generar una nueva clave de aplicación.

- Ejecuta el comando ` php artisan migrate ` para generar las tablas necesarias.

- Ejecuta el comando ` php artisan db:seed ` para generar la información inicial.

- Ejecuta el comando ` php artisan serve ` para iniciar el servidor.



- Seguido de las instrucciones, si todo a salido correctamente puede hacer uso de la api, todos los endpoint están documentados aquí: https://documenter.getpostman.com/view/28611521/2s946k5Vqy

## Credenciales iniciales 
  ***Usuario inicial***: admin1
  
  ***Contraseña inicial***: admin1

## Tip

- Asegúrese de configurar correctamente `SANCTUM_STATEFUL_DOMAINS` del ***.env***, este sera el dominio de la aplicación frontal realizará solicitudes a los endPoint, por ejemplo  ***SANCTUM_STATEFUL_DOMAINS: 127.0.0.1:5173*** dominio que ejecuta el entorno de desarrollo de React con vite, de ser diferente cámbielo, si no se configura correctamente recibirá error de políticas CORS al hacer peticiones a los endPoint 

- Asegure de configurar el dominio de las cookies de sesión `SESSION_DOMAIN` del ***.env***, agregando un punto un punto al inicio del dominio, por ejemplo : ***SESSION_DOMAIN: .127.0.0.1***

