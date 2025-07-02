<?php include("includes/header.php"); ?>
<main class="content-area">
  <section class="site-intro">
    <h2>Discover the stories of C.M. Schlosser &ndash; where mystery meets the macabre, and fiction leaves a lasting mark.</h2>
  </section>

  <?php
    $page = isset($_GET['page']) ? preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['page']) : 'index';
    $contentDir = __DIR__ . '/content/' . $page . '/';
    if (is_dir($contentDir)) {
        $files = array_diff(scandir($contentDir), ['.', '..']);
        natcasesort($files);
        foreach ($files as $file) {
            $path = $contentDir . $file;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if ($ext === 'txt') {
                $text = htmlspecialchars(file_get_contents($path), ENT_QUOTES, 'UTF-8');
                $text = nl2br($text);
                echo "<section class=\"content-block\"><p>{$text}</p></section>";
            } elseif (in_array($ext, ['jpg','jpeg','png','gif'])) {
                $src = 'content/' . $page . '/' . rawurlencode($file);
                $alt = htmlspecialchars(pathinfo($file, PATHINFO_FILENAME), ENT_QUOTES, 'UTF-8');
                echo "<section class=\"content-block\"><img src=\"{$src}\" alt=\"{$alt}\" style=\"max-width: 100%; height: auto;\"></section>";
            }
        }
    }
  ?>
</main>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/footer.php"); ?>
