<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Digital Ocean Dashboard</title>
    <link rel="stylesheet" href="css/dist/all.styles.min.css" media="screen" title="no title" charset="utf-8">
    <script type="text/javascript" src="js/dist/all.scripts.min.js"></script>
    <?php require_once(__DIR__ . '/../config.php'); ?>
  </head>
  <body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../main/">
          <?php if (isset($DO_LOGO_OR_NAME)) {
            echo $DO_LOGO_OR_NAME;
          } ?>
        </a>
      </div>
      <ul class="tab__content">
        <ul class="colors">
          <li data-color="#3bb873"></li>
          <li data-color="#f30a49"></li>
          <li data-color="#6b62ce"></li>
          <li data-color="#288fb4"></li>
          <li data-color="#f6538f"></li>
          <li data-color="#444"></li>
        </ul>
      </ul>
    <?php if ($DO_API_DEVELOPER_MODE == true): ?>
      <button class="btn btn-small" type="button" data-toggle="collapse" data-target="#collapseDeveloperMode" aria-expanded="false" aria-controls="collapseDeveloperMode">
        Developer Mode
      </button>
    <?php endif; ?>
    </div>
  </nav>
