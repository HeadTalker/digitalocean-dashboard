  <?php require_once '../main/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
      <?php require_once '../main/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main do-sshkeys">
          <table id="digitaloceantable" class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Fingerprint</th>
                <th>Name</th>
                <th>Public Key</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $endpoint = "https://api.digitalocean.com/v2/account/keys";
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
              foreach ($decoderesponse['ssh_keys'] as $sshkey) {
                $id = $sshkey['id'];
                $fingerprint = $sshkey['fingerprint'];
                $name = $sshkey['name'];
                $publickey = $sshkey['public_key'];
                echo "<tr><td>" . $id . "</td>";
                echo "<td>" . $fingerprint . "</td>";
                echo "<td>" . $name . "</td>";
                echo "<td>" . $publickey . "</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <script type="text/javascript">
          $(document).ready(function() {
              $('#digitaloceantable').DataTable({
                "aaSorting": [],
                "oLanguage": {
                    "sInfo": 'Showing _START_ to _END_ of _TOTAL_ SSH Keys.',
                    "sInfoEmpty": 'No SSH Keys yet.',
                    "sInfoFiltered": 'filtered from _MAX_ total SSH Keys',
                    "sZeroRecords": 'No SSH Keys Found',
                    "sLengthMenu": 'Show _MENU_ SSH Keys',
                    "sEmptyTable": "No SSH Keys found currently.",
                  }
                });
              });
          </script>
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
