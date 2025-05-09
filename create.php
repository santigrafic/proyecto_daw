<?php
session_start();
include 'auth_functions.php';
redirect_if_not_logged_in();
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title']);//trim() elimina los espacios en blanco del principio y del final del texto.
  $description = trim($_POST['description']);
  
  // Validación del lado del servidor
  $errors = [];
  
  if (empty($title)) {
    $errors[] = "El título es obligatorio.";
  } elseif (strlen($title) < 3) {
    $errors[] = "El título debe tener al menos 3 caracteres. PHP";
  }

  if (empty($errors)) {
    // Solo procesar si no hay errores y guardar en base de datos
    $stmt = $pdo->prepare("INSERT INTO tasks (title, description, user_id) VALUES (?, ?, ?)");
    $stmt->execute([$title, $description, $_SESSION['user_id']]);
    header("Location: index.php");
    exit;
  } else {
    $_SESSION['errors'] = $errors;//guarda los errores para la siguiente página/redireccion
    header("Location: create.php"); // Redirigir de vuelta al formulario
    exit;
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php if (!empty($_SESSION['errors'])): ?>
  <div class="alert alert-danger">
    <?php foreach ($_SESSION['errors'] as $error): ?>
      <p><?= htmlspecialchars($error) ?></p>
    <?php endforeach; ?>
  </div>
  <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<div class="container mt-5">
  <h2>Add New Task</h2>
  <form method="POST" onsubmit="return validateForm()" novalidate> <!--si hubiera error, validateForm() devuelve false, nunca se hará la petición al servidor
    <!--Si validateForm() devuelve false, el formulario NO se envía al servidor. Si devuelve true, el envío continúa normalmente.-->
    <!-- novalidate evita que el navegador aplique sus validaciones automáticas-->
    <div class="mb-3">
      <label class="form-label">Title</label>
      <input type="text" name="title" class="form-control">
      <div id="titleError" class="text-danger"></div>
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Task</button>
  </form>
</div>

<script>
function validateForm() {
  const titleInput = document.querySelector('input[name="title"]');
  const titleError = document.getElementById('titleError');
  let isValid = true;

  titleError.textContent = '';

  if (titleInput.value.trim() === '') {
    titleError.textContent = 'El título es obligatorio.';
    isValid = false;
  } else if (titleInput.value.trim().length < 3) {
    titleError.textContent = 'El título debe tener al menos 3 caracteres. Java';
    isValid = false;
  }

  return isValid;
}
</script>
</body>
</html>
