<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="<?php if (stripos($_SERVER['REQUEST_URI'], 'index.php')) { echo 'active'; }?>"><a href="../main/index.php">Droplets</a></li>
    <li class="<?php if (stripos($_SERVER['REQUEST_URI'], 'domains.php')) { echo 'active'; }?>"><a href="../main/domains.php">Domains</a></li>
    <li class="<?php if (stripos($_SERVER['REQUEST_URI'], 'images.php')) { echo 'active'; }?>"><a href="../main/images.php">Images</a></li>
    <li class="<?php if (stripos($_SERVER['REQUEST_URI'], 'sshkeys.php')) { echo 'active'; }?>"><a href="../main/sshkeys.php">SSH Keys</a></li>
    <li class="<?php if (stripos($_SERVER['REQUEST_URI'], 'account.php')) { echo 'active'; }?>"><a href="../main/account.php">Account</a></li>
  <?php if ($DO_RESOURCE_LINKS == true): ?>
    <hr>
    <li><a href="https://developers.digitalocean.com/documentation/v2/" target="blank">API Docs</a></li>
    <li><a href="https://cloud.digitalocean.com/support/tickets/new" target="blank">Support</a></li>
    <li><a href="https://www.digitalocean.com/community/tutorials" target="blank">Tutorials</a></li>
    <hr>
  <?php endif;?>
  </ul>
</div>
