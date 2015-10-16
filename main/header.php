<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Digital Ocean Dashboard</title>
    <link rel="stylesheet" href="css/all.styles.min.css" media="screen" title="no title" charset="utf-8">
    <script type="text/javascript" src="js/all.scripts.min.js"></script>
  </head>
  <body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="../main/">Digital Ocean Dashboard</a>
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
      <button class="btn btn-small" type="button" data-toggle="collapse" data-target="#collapseDeveloperMode" aria-expanded="false" aria-controls="collapseDeveloperMode">
        Developer Mode
      </button>
    </div>
  </nav>
  <?php require_once(__DIR__ . '/../config.php'); ?>
