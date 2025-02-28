# Gestión de Libros - Open Mind

## Descripción del Proyecto
Este proyecto es un sistema de gestión de libros desarrollado en PHP que permite registrar, actualizar, listar y eliminar libros. El sistema utiliza sesiones de PHP para almacenar temporalmente los datos y ofrece una interfaz de usuario intuitiva y atractiva construida con Bootstrap.

## Características
- **Registro de Libros**: Formulario para agregar nuevos libros con título, autor, precio y cantidad de ejemplares.
- **Edición de Libros**: Posibilidad de actualizar la información de los libros existentes.
- **Eliminación de Libros**: Opción para eliminar libros del inventario.
- **Listado de Libros**: Visualización de todos los libros registrados en formato de tabla.
- **Interfaz Responsiva**: Diseño adaptable a diferentes dispositivos gracias a Bootstrap.
- **Validación de Datos**: Validación tanto del lado del cliente (JavaScript) como del servidor (PHP).
- **Navegación Intuitiva**: Menú de navegación que facilita el acceso a las diferentes secciones del sistema.

## Estructura del Proyecto
```
GESTION-LIBROS/
│
├── 01-formulario.php           # Archivo principal de la aplicación
│
└── poo/                       # Carpeta con ejemplos de Programación Orientada a Objetos
    ├── 01-clases.php
    ├── 02-constructores-destructores.php
    ├── 03-public.php
    ├── 04-protected.php
    ├── 05-private.php
    ├── 06-getters-setters.php
    ├── 07-abstraccion.php
    ├── 08-encapsulacion.php
    └── 09-herencia.php
```

## Requisitos
- Servidor web con soporte para PHP (Apache, Nginx, etc.)
- PHP 7.0 o superior
- Navegador web moderno

## Instalación
1. Clone este repositorio o descargue los archivos en su servidor web:
   ```bash
   git clone https://github.com/kevinYugla/gestion-libros.git
   ```
2. Asegúrese de que el directorio tenga los permisos adecuados:
   ```bash
   chmod -R 755 GESTION-LIBROS
   ```
3. Acceda a la aplicación a través de su navegador web:
   ```
   http://localhost/GESTION-LIBROS/01-formulario.php
   ```

## Uso
### Página de Inicio
- La página principal muestra una bienvenida y proporciona acceso rápido a las principales funciones del sistema.

### Registro de Libros
1. Navegue a la sección "Registrar Libro" desde el menú.
2. Complete el formulario con la información del libro:
   - Título del libro
   - Nombre del autor
   - Precio (valor numérico positivo)
   - Cantidad de ejemplares (valor numérico positivo)
3. Haga clic en "Registrar Libro" para guardar la información.

### Listado de Libros
1. Acceda a la sección "Listado de Libros" desde el menú.
2. Visualice todos los libros registrados en formato de tabla.
3. Utilice los botones de acción para:
   - Editar la información de un libro existente
   - Eliminar un libro del sistema

### Actualización de Libros
1. En la lista de libros, haga clic en el botón de edición (ícono de lápiz) del libro que desea modificar.
2. El sistema lo redirigirá al formulario de registro con los datos del libro precargados.
3. Realice los cambios necesarios y haga clic en "Actualizar Libro".

### Contacto
- La sección de contacto proporciona información sobre la empresa y un formulario para enviar mensajes.

## Características Técnicas
- **Sesiones PHP**: El sistema utiliza sesiones para almacenar temporalmente la información de los libros.
- **Validación**: Implementa validación tanto del lado del cliente (JavaScript) como del servidor (PHP).
- **Sanitización de Datos**: Utiliza htmlspecialchars para prevenir ataques XSS.
- **Conversión de Tipos**: Asegura que los valores numéricos se almacenen con el tipo de dato correcto.
- **Mensajes de Alerta**: Proporciona retroalimentación al usuario sobre el resultado de sus acciones.

## Sobre los Ejemplos de POO
La carpeta "poo" contiene ejemplos de conceptos de Programación Orientada a Objetos en PHP, que sirven como material educativo complementario:
- **Clases y Objetos**: Definición y uso básico de clases.
- **Constructores y Destructores**: Inicialización y liberación de objetos.
- **Modificadores de Acceso**: Public, Protected y Private.
- **Getters y Setters**: Encapsulamiento y acceso controlado a atributos.
- **Abstracción**: Representación simplificada de entidades complejas.
- **Encapsulación**: Ocultamiento de la implementación interna.
- **Herencia**: Extensión de clases y reutilización de código.

## Autor
- **Kevin Yugla** - Universidad de las Fuerzas Armadas ESPE

## Licencia
Este proyecto está licenciado bajo la Licencia MIT - vea el archivo LICENSE para más detalles.
