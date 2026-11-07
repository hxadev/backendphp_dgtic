# env_php_dgtic

Entorno de desarrollo del **Módulo 8. Desarrollo backend con PHP**
Diplomado Desarrollo y Optimización de Sitios Web · DGTIC-UNAM

Autor: Alfonso Hernández Xochipa

PHP 8.5.12 · MySQL 8.4 · Apache · Composer

---

## Requisitos

Docker con Compose v2. Cualquiera de estas opciones funciona:

| Sistema | Opciones |
|---|---|
| Windows | Docker Desktop con WSL 2, Rancher Desktop, o Docker Engine dentro de WSL 2 |
| macOS | Docker Desktop, Rancher Desktop, OrbStack, Podman Desktop |
| Linux | Docker Engine + plugin Compose, o Podman con compatibilidad Compose |

Comprobación:

```bash
docker --version
docker compose version
```

> Docker Desktop requiere licencia de pago en organizaciones por encima de
> cierto tamaño. Las demás opciones son gratuitas y usan estos mismos
> archivos sin modificarlos.

---

## Arranque

```bash
docker compose pull
docker compose build
docker compose up -d
```

La primera vez tarda varios minutos. Conviene hacerlo con anticipación.

| Servicio | Dirección |
|---|---|
| Sitio, sesiones 1 a 4 | http://localhost:8080 |
| Sitio con raíz en `public/`, sesión 5 | http://localhost:8090 |
| phpMyAdmin | http://localhost:8081 |
| MySQL desde el equipo | `localhost:3307` |

Verificación: http://localhost:8080/verif.php

---

## Comandos frecuentes

```bash
docker compose logs -f web           # errores de PHP y Apache
docker compose exec web bash         # terminal dentro del contenedor
docker compose exec web php -v
docker compose exec web composer install
docker compose exec db mysql -u learnhub -plearnhub learnhub

docker compose down                  # detener
docker compose down -v               # detener y borrar la base de datos
```

Depuración con Xdebug, opcional:

```bash
docker compose --profile debug up -d web_debug   # http://localhost:8099
```

---

## Configuración

Puertos y credenciales están en `.env`. Si un puerto está ocupado, cámbialo
ahí y vuelve a ejecutar `docker compose up -d`.

Credenciales de la base: `learnhub` / `learnhub`.

Usuarios del panel, a partir de la sesión 3:

| Correo | Contraseña | Rol |
|---|---|---|
| admin@learnhub.mx | `Admin123!` | admin |
| editor@learnhub.mx | `Editor123!` | editor |

---

## Cuándo reconstruir

| Cambiaste | Qué hacer |
|---|---|
| Código PHP, HTML, CSS | Nada, recargar el navegador |
| `docker-compose.yml` o `.env` | `docker compose up -d` |
| `Dockerfile` o `custom.ini` | `docker compose build && docker compose up -d` |
| Los `.sql` de `database/` | `docker compose down -v && docker compose up -d` |

Los scripts de `database/` solo se ejecutan cuando el volumen se crea por
primera vez.

---

## Notas por sistema operativo

**Windows.** Requiere WSL 2 y virtualización habilitada en la BIOS. Para que
el acceso a archivos sea rápido, coloca el proyecto dentro del sistema de
archivos de WSL (`\\wsl$\...`) y no en `C:\Users\...`. El `.gitattributes`
evita que los archivos lleguen con finales de línea CRLF.

**macOS.** Sin pasos adicionales. Si el proyecto está en una carpeta
sincronizada con iCloud, muévelo fuera: la sincronización interfiere con los
volúmenes.

**Linux.** Los archivos que escriba PHP (subidas, archivos JSON) quedan a
nombre del usuario del contenedor. Si tu editor no los puede modificar:

```bash
sudo chown -R $USER:$USER .
```

En Fedora, RHEL y derivadas, SELinux bloquea los volúmenes y Apache responde
403. Los montajes ya llevan el sufijo `:z` para resolverlo; en Windows y
macOS ese sufijo se ignora.

---

## Si no puedes instalar Docker

El repositorio incluye `.devcontainer/`, así que puede abrirse en GitHub
Codespaces y levantar el mismo entorno desde el navegador.

Para las sesiones 1 y 2, que no usan base de datos, también sirve el servidor
integrado de PHP 8.5.12 instalado localmente:

```bash
php -S localhost:8080
```
