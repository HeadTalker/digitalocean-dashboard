  <?php require_once '../main/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
      <?php require_once '../main/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main do-account">
          <?php
          $endpoint = "https://api.digitalocean.com/v2/account";
          $headers[] = "Content-type: application/json";
          $headers[] = "Authorization: Bearer $DO_API_TOKEN";
          $curl = curl_init();
          curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_URL            => $endpoint,
          ]);
          $response = curl_exec($curl);
          $decoderesponse = json_decode($response, true);
          echo "<div class='col-md-12 account-info'><h3>Email</h3><h5>" . $decoderesponse['account']['email'] . "</h5></div>";
          echo "<div class='col-md-12 account-info'><h3>Droplet Limit</h3><h5>" . $decoderesponse['account']['droplet_limit'] . "</h5></div>";
          echo "<div class='col-md-12 account-info'><h3>Email Verified</h3><h5>";
          if ($decoderesponse['account']['email_verified'] == true) {
            echo "Yes";
          } else {
            echo "No";
          };
          echo "</h4></div>";
          echo "<div class='col-md-12 account-info'><h3>Unique User ID</h3><h5>" . $decoderesponse['account']['uuid'] . "</h5></div>";
          ?>
        <?php if ($DO_API_DEVELOPER_MODE == true): ?>
          <div class="collapse" id="collapseDeveloperMode">
            <div class="well">
              <?php
                echo "<pre>";
                print_r(json_decode($response, 1));
                echo "</pre>";
              ?>
            </div>
          </div>
        <?php endif; ?>
        </div>
      </div>
    </div>
  </body>
</html>
