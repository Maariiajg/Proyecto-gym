# Documentación Técnica Detallada: Proyecto Trena Elite

Esta documentación describe la arquitectura y el desarrollo técnico del sistema de gestión de gimnasio "Trena Elite", centrándose en las funcionalidades de privacidad, planificación dinámica y experiencia de usuario premium.

---

## 4.1 Base de Datos

### Diagrama Entidad-Relación y Lógica Relacional
El sistema utiliza una base de datos relacional (MySQL) diseñada para soportar un ecosistema de entrenamiento donde conviven rutinas globales (de sistema) y personales.

*   **Users**: Entidad central. Almacena credenciales, datos de perfil y marcas de tiempo para borrado lógico (`softDeletes`).
*   **Exercises**: Biblioteca técnica. Contiene la definición de cada movimiento, nivel de dificultad y grupo muscular objetivo.
*   **Routines**: Colecciones de ejercicios. Poseen un `creator_id` que es la clave para la lógica de privacidad del sistema.
*   **Exercise_Routine (Pivote)**: Relación N:N que permite la reutilización de ejercicios. Incluye atributos de ejecución: `sets`, `reps` y `rest_time_seconds`.
*   **Weekly_Plans**: Tabla de planificación que asigna una `routine_id` a un `user_id` para un `day_of_week` (lunes-domingo).
*   **Exercise_Logs & Routine_Logs**: Tablas transaccionales que registran la actividad diaria del usuario para generar métricas de progreso.

### Migraciones y Estructura de Tablas
1.  **Tablas de Usuarios**: Implementada con campos para nombre, email y contraseña encriptada. Se ha añadido `softDeletes` para que los administradores puedan "desactivar" usuarios sin perder su historial de récords.
2.  **Biblioteca Técnica (`exercises`)**: Incluye campos de texto largo para descripciones y una URL de vídeo para demostraciones técnicas.
3.  **Sistema de Rutinas (`routines`)**: Clave primaria autoincremental y relación foránea con `users.id` para identificar al propietario.
4.  **Planificación (`weekly_plans`)**: Utiliza una combinación de `user_id`, `routine_id` y un enumerado para el día de la semana, asegurando que la planificación sea fluida y persistente.

### Seeders y Datos de Inicio
*   **RoleSeeder**: Configura los roles `admin` y `client` mediante la librería Spatie.
*   **ExerciseSeeder**: Carga una base de datos real de ejercicios con descripciones orientadas al fitness profesional.
*   **RoutineSeeder**: Configura las rutinas iniciales del gimnasio (Full Body, Push-Pull-Legs) que todos los clientes ven por defecto.

---

## 4.2 Modelos (Eloquent)

El uso de Eloquent ha permitido abstraer la complejidad de la base de datos mediante clases de alto nivel.

### Modelo `Routine` y el "Visibility Scope"
Es el corazón de la privacidad del proyecto. Utiliza un `Global Scope` llamado `visibility` que se activa en cada consulta:
*   **Si eres Cliente**: Solo recuperas rutinas creadas por ti O rutinas creadas por un Administrador (rutinas oficiales).
*   **Si eres Admin**: Solo ves tus propias rutinas de sistema, manteniendo la privacidad absoluta de los entrenamientos personales de los clientes (ni siquiera el admin puede verlos por diseño).

### Modelo `Exercise` e Integración Multimedia
Se integra con `Spatie MediaLibrary` para gestionar imágenes de referencia de forma eficiente, permitiendo que cada ejercicio tenga una representación visual clara.

### Modelo `WeeklyPlan`
Define las relaciones `belongsTo` con `User` y `Routine`. Es el modelo que alimenta tanto el widget del dashboard como el planificador interactivo.

---

## 4.3 Controladores y Lógica de Negocio

Se ha seguido el patrón MVC, delegando la lógica pesada a componentes Livewire y manteniendo los controladores para la gestión estructural.

### UserController
*   **Finalidad**: Gestión de la comunidad del gimnasio.
*   **Middleware**: Protegido por `auth` y `role:admin`. Nadie excepto el administrador puede crear o modificar perfiles de usuario.
*   **Funciones**: Implementa la lógica de restauración de usuarios eliminados mediante `withTrashed()`.

### ExerciseController & RoutineController
*   **Control de Acceso**: Los clientes tienen acceso de "Solo Lectura" (`index`, `show`), mientras que los administradores poseen el control total de edición.
*   **Constructor**: Todos los controladores utilizan el constructor para inyectar políticas de seguridad, asegurando que un cliente nunca pueda acceder a las rutas de creación o borrado.

---

## 4.4 Vistas y Experiencia de Usuario (UX)

### Arquitectura de Vistas Blade
La interfaz se basa en un sistema de herencia de layouts:
*   **Layout `app`**: Estructura de panel lateral (Sidebar) con un diseño **Dark Glassmorphism**. Utiliza desenfoques de fondo (backdrop-blur), bordes sutiles y sombras profundas para un aspecto premium.
*   **Layout `guest`**: Utilizado en login y registro, manteniendo la misma estética oscura para una transición visual coherente.

### Componentes Livewire (Interactividad)
1.  **WeeklyPlanner**: Permite al cliente organizar su semana. Se ha optimizado para que el cliente solo vea su propio plan, mientras que el administrador tiene una versión global para supervisar a todos los atletas.
2.  **ExerciseManager**: Implementa una biblioteca "clicable". Al pulsar en la tarjeta de un ejercicio, Livewire carga dinámicamente toda la información técnica, vídeos y récords sin recargar la página.
3.  **AdminPlanner**: Panel exclusivo de administración con búsqueda en tiempo real de atletas y visualización de frecuencia semanal mediante iconos dinámicos.

### Personalización del Dashboard
El Dashboard es **polimórfico**:
*   **Versión Atleta**: Enfocada al rendimiento, con gráficos de volumen, récords personales y acceso rápido al entrenamiento del día.
*   **Versión Admin**: Enfocada a la gestión, sustituyendo los gráficos de rendimiento por contadores de usuarios, estado del servidor y accesos directos a la administración de la base de datos.

---

## Tecnologías Utilizadas
*   **Framework**: Laravel 11.x
*   **Frontend**: Tailwind CSS (con configuraciones personalizadas para Dark Mode) y Livewire 3.
*   **Seguridad**: Spatie Laravel-Permission para el control de acceso basado en roles.
*   **Multimedia**: Spatie MediaLibrary para la gestión de activos visuales.
*   **Diseño**: Estética Premium Dark / Glassmorphism.
