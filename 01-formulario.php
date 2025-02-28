<?php
// Iniciar la sesión para almacenar datos de libros
session_start();

// Inicializar la variable de sesión 'libros' si no existe
if (!isset($_SESSION['libros'])) {
    $_SESSION['libros'] = [];
}

// Función para obtener la lista de libros almacenados
function obtenerLibros() {
    return $_SESSION['libros'];
}

// Función para agregar un libro a la lista
function agregarLibro($titulo, $autor, $precio, $ejemplares) {
    // Validar los campos antes de agregar
    if (validarCampos($titulo, $autor, $precio, $ejemplares)) {
        // Agregar el libro a la sesión
        $_SESSION['libros'][] = [
            'titulo' => htmlspecialchars($titulo),   // Sanitizar el título
            'autor' => htmlspecialchars($autor),     // Sanitizar el autor
            'precio' => (float)$precio,              // Convertir precio a número flotante
            'ejemplares' => (int)$ejemplares,        // Convertir ejemplares a número entero
        ];
        return true; // Indicar éxito
    }
    return false; // Indicar fallo
}

// Función para actualizar un libro existente
function actualizarLibro($index, $titulo, $autor, $precio, $ejemplares) {
    // Verificar que el libro existe y los campos son válidos
    if (isset($_SESSION['libros'][$index]) && validarCampos($titulo, $autor, $precio, $ejemplares)) {
        // Actualizar los valores del libro en la sesión
        $_SESSION['libros'][$index] = [
            'titulo' => htmlspecialchars($titulo),   // Sanitizar el título
            'autor' => htmlspecialchars($autor),     // Sanitizar el autor
            'precio' => (float)$precio,              // Convertir precio a número flotante
            'ejemplares' => (int)$ejemplares,        // Convertir ejemplares a número entero
        ];
        return true; // Indicar éxito
    }
    return false; // Indicar fallo
}

// Función para eliminar un libro por su índice
function eliminarLibro($index) {
    // Verificar que el índice existe en la lista
    if (isset($_SESSION['libros'][$index])) {
        // Eliminar el libro usando array_splice
        array_splice($_SESSION['libros'], $index, 1);
        return true; // Indicar éxito
    }
    return false; // Indicar fallo
}

// Función para validar los campos del formulario
function validarCampos($titulo, $autor, $precio, $ejemplares) {
    // Verificar que el título y autor no estén vacíos y que precio y ejemplares sean mayores a 0
    return !empty($titulo) && !empty($autor) && $precio > 0 && $ejemplares > 0;
}

// Variables para manejar mensajes y valores del formulario
$alerta = ''; // Mensaje para alertar al usuario
$titulo = ''; // Título del libro (vacío por defecto)
$autor = ''; // Autor del libro (vacío por defecto)
$precio = ''; // Precio del libro (vacío por defecto)
$ejemplares = ''; // Ejemplares disponibles (vacío por defecto)
$index = null; // Índice del libro para edición
$page = $_GET['page'] ?? 'inicio'; // Página actual (inicio por defecto)

// Procesar solicitudes POST (para agregar o actualizar libros)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Inicializar todas las variables POST para evitar advertencias
    $_POST = array_merge([
        'titulo' => '',
        'autor' => '',
        'precio' => 0,
        'ejemplares' => 0,
        'index' => null
    ], $_POST);
    
    // Obtener valores del formulario
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $precio = $_POST['precio'];
    $ejemplares = $_POST['ejemplares'];
    $index = $_POST['index'];

    if ($index !== null && $index !== '' && is_numeric($index)) {
        // Actualizar libro si se proporciona un índice válido
        if (actualizarLibro((int)$index, $titulo, $autor, $precio, $ejemplares)) {
            $alerta = "Libro actualizado exitosamente.";
            // Limpiar los valores del formulario después de actualizar
            $titulo = $autor = $precio = $ejemplares = '';
            // Redirigir a la lista de libros
            header("Location: ?page=listado");
            exit;
        } else {
            $alerta = "Error al actualizar el libro.";
        }
    } else {
        // Agregar libro si no se proporciona un índice
        if (agregarLibro($titulo, $autor, $precio, $ejemplares)) {
            $alerta = "Libro registrado exitosamente.";
            // Limpiar los valores del formulario después de agregar
            $titulo = $autor = $precio = $ejemplares = '';
            // Redirigir a la lista de libros
            header("Location: ?page=listado");
            exit;
        } else {
            $alerta = "Error al registrar el libro. Verifica los campos.";
        }
    }
}

// Procesar solicitudes GET (para eliminar o editar libros)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? ''; // Obtener acción (edit o delete)
    $index = $_GET['index'] ?? null; // Obtener índice del libro

    if ($action === 'delete' && is_numeric($index)) {
        // Eliminar libro si la acción es delete y el índice es válido
        if (eliminarLibro((int)$index)) {
            $alerta = "Libro eliminado correctamente.";
        } else {
            $alerta = "Error al eliminar el libro.";
        }
    } elseif ($action === 'edit' && is_numeric($index)) {
        // Cargar datos del libro para edición
        $libro = $_SESSION['libros'][$index] ?? null;
        if ($libro) {
            $titulo = $libro['titulo'];
            $autor = $libro['autor'];
            $precio = $libro['precio'];
            $ejemplares = $libro['ejemplares'];
            $index = (int)$index;
            $page = 'registro'; // Mostrar la página de registro para editar
        }
    }
}

// Obtener la lista de libros
$libros = obtenerLibros();

// Función para renderizar la tabla de libros
function renderizarTabla($libros) {
    if (empty($libros)) {
        // Mostrar mensaje si no hay libros
        echo "<tr><td colspan='6' class='text-center'>No existen libros registrados</td></tr>";
    } else {
        foreach ($libros as $index => $libro) {
            // Renderizar cada libro como una fila de la tabla
            echo "
                <tr>
                    <td>" . ($index + 1) . "</td>
                    <td>" . $libro['titulo'] . "</td>
                    <td>" . $libro['autor'] . "</td>
                    <td>$" . number_format($libro['precio'], 2) . "</td>
                    <td>" . $libro['ejemplares'] . "</td>
                    <td>
                        <a href='?action=edit&index=$index' class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></a>
                        <a href='?action=delete&index=$index' class='btn btn-sm btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar este libro?\")'><i class='fas fa-trash'></i></a>
                    </td>
                </tr>
            ";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Libros - Open Mind</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('https://i.ibb.co/jkCtfqtp/japanese-anime-girl-student-train-station-gomr5uz81d5gqeua.jpg');
            background-size: cover;
            background-attachment: fixed;
            color: white;
            min-height: 100vh;
            padding-bottom: 60px;
            position: relative;
        }
        
        .container {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            margin-bottom: 30px;
        }
        
        footer {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 0;
            color: white;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        
        .form-container {
            background-color: rgba(0, 0, 0, 0.6);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .table {
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
        }
        
        .table thead {
            background-color: rgba(0, 0, 0, 0.7);
        }
        
        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
    <script>
        // Función para validar el formulario antes de enviarlo
        function validarFormulario() {
            const titulo = document.getElementById('titulo').value.trim();
            const autor = document.getElementById('autor').value.trim();
            const precio = parseFloat(document.getElementById('precio').value);
            const ejemplares = parseInt(document.getElementById('ejemplares').value);

            // Validar que el título no esté vacío
            if (titulo === '') {
                alert('El título no puede estar vacío.');
                return false;
            }
            
            // Validar que el autor no esté vacío
            if (autor === '') {
                alert('El nombre del autor no puede estar vacío.');
                return false;
            }

            // Validar que el precio sea un número positivo
            if (isNaN(precio) || precio <= 0) {
                alert('El precio debe ser un número mayor a 0.');
                return false;
            }

            // Validar que el stock sea un número positivo
            if (isNaN(ejemplares) || ejemplares <= 0) {
                alert('La cantidad de ejemplares debe ser un número mayor a 0.');
                return false;
            }

            return true; // Formulario válido
        }

        // Mostrar alerta en pantalla después de una acción
        <?php if (!empty($alerta)) : ?>
            document.addEventListener('DOMContentLoaded', function() {
                alert('<?php echo $alerta; ?>');
            });
        <?php endif; ?>
    </script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="?page=inicio">Open Mind</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link <?php echo $page === 'inicio' ? 'active' : ''; ?>" href="?page=inicio">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $page === 'registro' ? 'active' : ''; ?>" href="?page=registro">Registrar Libro</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $page === 'listado' ? 'active' : ''; ?>" href="?page=listado">Listado de Libros</a></li>
                    <li class="nav-item"><a class="nav-link <?php echo $page === 'contacto' ? 'active' : ''; ?>" href="?page=contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <?php if ($page === 'inicio') : ?>
            <div class="welcome-text">
                <h2>Bienvenido a Open Mind</h2>
                <p>Los libros son portales mágicos que nos permiten viajar a mundos desconocidos, aprender de experiencias pasadas y vislumbrar futuros posibles. En Open Mind, creemos que la lectura es una de las herramientas más poderosas para el crecimiento personal y profesional. A través de este sistema de gestión de libros, buscamos facilitar el acceso, organización y disfrute de los conocimientos que ofrecen los libros.</p>
                <p>Este proyecto ha sido creado con dedicación por Kevin Yugla, estudiante de la Universidad de las Fuerzas Armadas ESPE. Mi objetivo es proporcionar una herramienta sencilla pero poderosa que ayude a gestionar y disfrutar de los libros, favoreciendo el aprendizaje y el acceso al conocimiento.</p>
            </div>
            
            <div class="row mt-4">
                <div class="col-md-4 mb-3">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-book fa-3x mb-3"></i>
                            <h5 class="card-title">Gestión de Libros</h5>
                            <p class="card-text">Registra y organiza tus libros fácilmente.</p>
                            <a href="?page=registro" class="btn btn-primary">Registrar Libro</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-list fa-3x mb-3"></i>
                            <h5 class="card-title">Catálogo Completo</h5>
                            <p class="card-text">Visualiza todos tus libros en un solo lugar.</p>
                            <a href="?page=listado" class="btn btn-primary">Ver Listado</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card bg-dark text-white">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope fa-3x mb-3"></i>
                            <h5 class="card-title">Contáctanos</h5>
                            <p class="card-text">¿Necesitas ayuda? Estamos para apoyarte.</p>
                            <a href="?page=contacto" class="btn btn-primary">Contacto</a>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php elseif ($page === 'registro') : ?>
            <h2 class="text-center mb-4"><?php echo isset($index) ? 'Actualizar Libro' : 'Registrar Nuevo Libro'; ?></h2>
            <div class="form-container">
                <!-- Formulario para agregar o actualizar libros -->
                <form id="form-libro" method="POST" onsubmit="return validarFormulario();">
                    <input type="hidden" name="index" value="<?php echo htmlspecialchars($index ?? ''); ?>">
                    
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título del libro:</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="autor" class="form-label">Nombre del autor:</label>
                        <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($autor ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" value="<?php echo htmlspecialchars($precio ?? ''); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="ejemplares" class="form-label">Ejemplares disponibles:</label>
                        <input type="number" class="form-control" id="ejemplares" name="ejemplares" value="<?php echo htmlspecialchars($ejemplares ?? ''); ?>">
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success"><?php echo isset($index) ? 'Actualizar Libro' : 'Registrar Libro'; ?></button>
                        <button type="button" class="btn btn-danger" onclick="location.href='?page=registro';">Limpiar</button>
                    </div>
                </form>
            </div>
        
        <?php elseif ($page === 'listado') : ?>
            <h2 class="text-center mb-4">Catálogo de Libros</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Precio</th>
                            <th>Ejemplares</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php renderizarTabla($libros); ?>
                    </tbody>
                </table>
            </div>
            <div class="d-grid gap-2 col-md-6 mx-auto mt-4">
                <a href="?page=registro" class="btn btn-success"><i class="fas fa-plus"></i> Agregar Nuevo Libro</a>
            </div>
        
        <?php elseif ($page === 'contacto') : ?>
            <h2 class="text-center mb-4">Contacto</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="form-container">
                        <h3>Información de Contacto</h3>
                        <p><i class="fas fa-building me-2"></i> <strong>Open Mind Library</strong></p>
                        <p><i class="fas fa-map-marker-alt me-2"></i> Av. Gral. Rumiñahui, Sangolquí 171103</p>
                        <p><i class="fas fa-phone me-2"></i> (02) 3989-400</p>
                        <p><i class="fas fa-envelope me-2"></i> info@openmind.com</p>
                        <p><i class="fas fa-clock me-2"></i> Lunes a Viernes: 9:00 - 18:00</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-container">
                        <h3>Envíanos un mensaje</h3>
                        <form>
                            <div class="mb-3">
                                <label for="nombre-contacto" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre-contacto" name="nombre-contacto" required>
                            </div>
                            <div class="mb-3">
                                <label for="email-contacto" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email-contacto" name="email-contacto" required>
                            </div>
                            <div class="mb-3">
                                <label for="mensaje" class="form-label">Mensaje:</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                            </div>
                            <div class="d-grid">
                                <button type="button" class="btn btn-primary" onclick="alert('Mensaje enviado (simulación).');">Enviar mensaje</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <p><small>© 2025 Open Mind - Gestión de Libros. Todos los derechos reservados.</small></p>
            <p><small>Desarrollado por Kevin Yugla - Universidad de las Fuerzas Armadas ESPE</small></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>