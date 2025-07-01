<?php include("includes/header.php"); ?>
<main class="content-area">
  <section class="featured-book">
    <h2>Featured Book</h2>
    <p>Showcase your latest novel here with a description and buy links.</p>
  </section>
  <section class="main-content">
    <p>Welcome to the official site of C.M. Schlosser, author of speculative fiction and haunting tales.</p>
  </section>
  
  <?php
    $contentDir = __DIR__ . '/content/index/';
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
                $src = 'content/index/' . rawurlencode($file);
                $alt = htmlspecialchars(pathinfo($file, PATHINFO_FILENAME), ENT_QUOTES, 'UTF-8');
                echo "<section class=\"content-block\"><img src=\"{$src}\" alt=\"{$alt}\" style=\"max-width: 100%; height: auto;\"></section>";
            }
        }
    }
  ?>
</main>
<?php include("includes/footer.php"); ?>
