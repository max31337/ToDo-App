<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Todo App'; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php if (!isset($excludeHeaderFooter) || !$excludeHeaderFooter): ?>
        <?php include '../views/header.php'; ?>
    <?php endif; ?>

    <div class="container">
        <div class="main-content">
            <?php echo isset($content) ? $content : ''; ?>
        </div>
    </div>

    <?php if (!isset($excludeHeaderFooter) || !$excludeHeaderFooter): ?>
        <?php include '../views/footer.php'; ?>
    <?php endif; ?>
</body>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../assets/js/navbar.js"></script>
</html>
