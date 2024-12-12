# Proyecto Informático F.P

## Objetivo
Implementar un sistema donde los usuarios pueden publicar noticias y otros pueden comentar. Los administradores gestionan las noticias, comentarios y moderan el contenido.

## Requisitos
- PHP/MySQL
- HTML/CSS
- Bootstrap para el diseño y la interactividad

## Funcionalidades
### Gestión de Usuarios
- Registro de usuarios (usuario común y administrador).
- Inicio de sesión y cierre de sesión.
- Perfil de usuario con información básica (nombre, foto de perfil, etc.).

### Publicación de Noticias
- Los usuarios registrados pueden cargar, editar y eliminar sus propias noticias.
- Las noticias incluyen título, cuerpo del texto, imágenes y/o archivos multimedia.
- Clasificación de noticias en categorías o etiquetas.

### Comentarios
- Los usuarios registrados pueden realizar comentarios en las noticias.
- Los usuarios pueden modificar sus comentarios pero no los de otros usuarios.

### Gestión de Administradores
- El administrador puede editar o eliminar cualquier noticia.
- El administrador puede editar o eliminar cualquier comentario.
- El administrador tiene acceso a estadísticas sobre la actividad de la plataforma (número de noticias, comentarios, usuarios activos, etc.).

### Buscador y Filtrado
- Búsqueda de noticias por título, contenido, autor o etiquetas.
- Filtros para clasificar noticias por fecha, categoría, autor, etc.

## Requerimientos No Funcionales
- Cifrado de contraseñas.
- Autenticación segura (opcionalmente con doble factor).
- Validación de formularios para evitar la inyección de SQL y XSS.
- Permisos diferenciados para usuarios comunes y administradores.
- Tiempo de respuesta rápido.
- Optimización de imágenes y multimedia.
- Diseño responsive para acceso desde dispositivos móviles y de escritorio.

## Modelo Entidad-Relación (ER)
### Entidades Principales
1. **Usuario:** Maneja la información de los usuarios registrados, incluyendo administradores y usuarios regulares.
2. **Noticia:** Contiene la información de las noticias publicadas por los usuarios.
3. **Comentario:** Representa los comentarios que los usuarios dejan en las noticias.
4. **Categoría:** Almacena las categorías de las noticias.
5. **Rol:** Define los roles (administrador, usuario).

### Relaciones
- Un usuario puede tener múltiples noticias.
- Un usuario puede hacer múltiples comentarios.
- Una noticia puede tener múltiples comentarios.
- Una noticia pertenece a una categoría.

## Desarrollo del Proyecto
### Entorno de Desarrollo
- Configurar un servidor local (XAMPP, MAMP, etc.).
- Crear la base de datos y las tablas necesarias.

### Estructura de Archivos
Organiza el proyecto en las siguientes carpetas:
/public /css /js /views /controllers /models

### Funcionalidades del Proyecto
- Registro y autenticación de usuarios.
- Publicación, edición y eliminación de noticias.
- Sistema de comentarios.
- Panel de administración para la gestión de noticias, comentarios y usuarios.

## Pruebas
### Tipos de Pruebas
- Pruebas Unitarias: Verificar funciones individuales.
- Pruebas Funcionales: Asegurar que el sistema cumple con los requerimientos.
- Pruebas de Integración: Comprobar que los módulos funcionan en conjunto.

### Herramientas de Testing
- **PHPUnit:** Framework para pruebas unitarias y de integración en PHP.
- **Postman:** Herramienta para probar las APIs del sistema.
- **Selenium (opcional):** Para pruebas de interfaz de usuario.

## Despliegue del Proyecto
- Realizar pruebas locales.
- Asegurar el funcionamiento en el servidor local antes del despliegue final.

## Contribuciones
Las contribuciones son bienvenidas. Por favor, abre un issue para discutir cualquier cambio que quieras realizar.

## Licencia
Este proyecto está bajo la Licencia MIT.
