# TStore

Este proyecto tiene como objetivo crear una página web para vender merchandising de Taylor Swift. El desarrollo se llevará a cabo sin el uso de frameworks, utilizando PHP y JavaScript.

## Índice

1. [Pre-requisitos](#pre-requisitos)
2. [Instalación](#instalación)
   1. [Clonar el repositorio](#clonar-el-repositorio)
   2. [Configurar la base de datos](#configurar-la-base-de-datos)
   3. [Configurar el entorno](#configurar-el-entorno)
   4. [Instalar dependencias](#instalar-dependencias)
3. [Iniciar el servidor de desarrollo](#iniciar-el-servidor-de-desarrollo)
4. [Uso](#uso)

## Pre-requisitos

Lista de software necesario para instalar y ejecutar el proyecto:
- PHP 8.2.12 o superior
- MySQL 5.7 o superior
- Composer (para gestionar dependencias PHP)
- Un servidor web como Apache o Nginx

## Instalación

### Clonar el repositorio
```bash
git clone https://github.com/Ainhoa5/TStore.git
cd TStore
```

### Configurar la base de datos

Crea una base de datos MySQL y un usuario con los permisos adecuados. Luego, importa .sql proporcionado en other/sql para crear la base de datos y su estructura

### Configurar el entorno

Copia el archivo .env.example a .env y ajusta las variables de entorno según tu configuración:
cp .env.example .env
```bash
cp .env.example .env
```
Edita .env para configurar las credenciales de la base de datos, el entorno de aplicación y cualquier otra configuración necesaria.

### Instalar dependencias

Utiliza Composer para instalar las dependencias del proyecto:

```bash
composer install
```

## Iniciar el servidor de desarrollo

Si estás utilizando PHP's built-in server:

```bash
php -S localhost:3000 -t public
```

## Uso

Lee la documentación para comprender la estructura y funcionamiento de la aplicación