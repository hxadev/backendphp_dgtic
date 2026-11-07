# 🎓 LearnHub UI

Interfaz web de **LearnHub**, una plataforma de cursos en línea. Este frontend es parte del


## Stack

- [React 18](https://react.dev/) + [Vite](https://vitejs.dev/)
- [React Router DOM](https://reactrouter.com/) — navegación
- [Tailwind CSS](https://tailwindcss.com/) — estilos
- [Lucide React](https://lucide.dev/) — íconos
- [Recharts](https://recharts.org/) — gráficas del dashboard y reportes

## Cómo ejecutar

```bash
npm install
npm run dev
```

Abre http://localhost:5173. En la pantalla de login **cualquier email funciona**; si el email
contiene `admin` entras con rol de administrador.

## Conectar con tu backend (Sesión 4)

1. Levanta tu API REST en `http://localhost:8080`.
2. En `src/services/api.js` cambia `USE_MOCKS` a `false`.
3. (Opcional) Define otra URL en `.env`: `VITE_API_URL=http://mi-servidor:8080/api`.

La página **Conexión Backend** (`/backend-status`) lista todos los endpoints que tu backend debe
exponer y tiene un botón para probar la conexión.

## Estructura

```
src/
├── components/    # Layout, Sidebar, DataTable, Modal, badges, etc.
├── context/       # AuthContext (sesión simulada en localStorage)
├── mocks/         # Datos mock (coinciden con el modelo de datos del backend)
├── pages/         # Login, Dashboard, Catálogo, CRUDs, Reportes, Conexión Backend
├── services/      # Un servicio por entidad + api.js (bandera USE_MOCKS)
└── utils/         # Formateadores (moneda MXN, fechas, nombres)
```

## Modelo de datos

Las colecciones mock replican exactamente las tablas del backend
`levels`, `categories`, `instructors`, `courses`, `instructors_courses` (N:M), `modules`,
`students` y `enrollments`. 

---

DGTIC-UNAM · [hxadev.tech](https://hxadev.tech)
