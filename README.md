# LearnHub

Plataforma de apoyo al **Diplomado Desarrollo y Optimización de Sitios Web**
de la DGTIC-UNAM.

Autor: Alfonso Hernández Xochipa — Instructor certificado DGTIC-UNAM

---

## Componentes

```
learnhub/
├── db/
│   └── learnhub/        Esquema y datos de la plataforma (SQL)
├── learnhub-ui/         Interfaz de usuario (React)
└── env_php_dgtic/       Entorno PHP del módulo 8 (Docker)
```

| Componente | Qué contiene | Tecnología |
|---|---|---|
| `db/learnhub` | Scripts de esquema y datos iniciales | MySQL 8.4 |
| `learnhub-ui` | Interfaz web de la plataforma | React |
| `env_php_dgtic` | Entorno de desarrollo del módulo de PHP | Docker, PHP 8.5.12, Apache, MySQL 8.4 |

Los tres componentes son independientes: cada uno se levanta por separado y
no hay un orquestador en la raíz.

---

## Requisitos

| Herramienta | Para qué |
|---|---|
| Docker con Compose v2 | `env_php_dgtic` |
| Node.js 20 o superior | `learnhub-ui` |
| Git | Todo el repositorio |

Funciona en Windows, macOS y Linux. Las particularidades de cada sistema
están documentadas en `env_php_dgtic/README.md`.

---

## Arranque

### Entorno PHP

```bash
cd env_php_dgtic
docker compose up -d
```

| Servicio | Dirección |
|---|---|
| Sitio, sesiones 1 a 4 | http://localhost:8080 |
| Sitio con raíz en `public/`, sesión 5 | http://localhost:8090 |
| phpMyAdmin | http://localhost:8081 |
| MySQL desde el equipo | `localhost:3307` |

Verificación del entorno: http://localhost:8080/verif.php

Los detalles completos, incluidos los comandos de uso diario y la solución
de problemas, están en `env_php_dgtic/README.md`.

### Interfaz

```bash
cd learnhub-ui
npm install
npm run dev
```

### Base de datos de la plataforma

Los scripts de `db/learnhub` se aplican en orden sobre una instancia de
MySQL 8.4:

```bash
mysql -h 127.0.0.1 -P 3307 -u root -p < db/learnhub/01_schema.sql
mysql -h 127.0.0.1 -P 3307 -u root -p < db/learnhub/02_seeds.sql
```

El entorno `env_php_dgtic` carga automáticamente los scripts de su propia
carpeta `database/` la primera vez que se crea el volumen. Esa base es
independiente de la de LearnHub.

---

## Variables de entorno

Cada componente tiene su propio archivo de configuración:

| Componente | Archivo | Se versiona |
|---|---|---|
| `env_php_dgtic` | `.env` | Sí. Solo contiene puertos y credenciales locales desechables |
| `learnhub-ui` | `.env.local` | No |
| `db/learnhub` | — | Las credenciales llegan por línea de comandos |

Los nombres de variable se escriben en inglés y en `SNAKE_CASE` mayúsculo.

Nunca se versionan credenciales de producción, cadenas de conexión reales ni
claves de API.

---

## Convenciones

**Ramas.** `main` es la rama estable. El trabajo se hace en ramas con
prefijo: `feat/`, `fix/`, `docs/`, `chore/`.

**Mensajes de commit.** En imperativo y en español, indicando el componente
cuando aplica:

```
feat(ui): agregar listado de módulos
fix(php-env): corregir raíz pública del servicio web_mvc
docs: actualizar requisitos de instalación
```

**Finales de línea.** El repositorio normaliza a LF mediante
`.gitattributes`. Quien trabaje en Windows no necesita configurar nada.

**Qué no se versiona.** `node_modules/`, `vendor/`, volúmenes de Docker,
archivos subidos por la aplicación y cualquier `.env` con credenciales
reales.

---

## Estructura detallada

```
learnhub/
├── db/
│   └── learnhub/
│       ├── 01_schema.sql
│       └── 02_seeds.sql
│
├── learnhub-ui/
│   ├── src/
│   ├── public/
│   ├── package.json
│   └── vite.config.js
│
├── env_php_dgtic/
│   ├── .devcontainer/
│   │   └── devcontainer.json
│   ├── database/
│   │   ├── 01_schema.sql
│   │   └── 02_seeds.sql
│   ├── docker/
│   │   └── php/
│   │       ├── Dockerfile
│   │       ├── custom.ini
│   │       ├── vhost.conf
│   │       └── xdebug.ini
│   ├── public/
│   │   └── index.php
│   ├── .dockerignore
│   ├── .env
│   ├── .gitattributes
│   ├── README.md
│   └── verif.php
│
├── .gitattributes
├── .gitignore
└── README.md
```

---

## Notas

El entorno PHP está fijado a **PHP 8.5.12**, que incluye los parches de las
vulnerabilidades críticas publicadas en octubre de 2026 y tiene soporte
activo hasta diciembre de 2027. La versión no debe cambiarse sin revisar
antes `env_php_dgtic/README.md`, porque los instrumentos de evaluación del
módulo comparan contra ese número.
