  <?php require_once '../main/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
      <?php require_once '../main/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main do-domains">
          <table id="digitaloceantable" class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>ttl</th>
                <th>Zone File</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $endpoint = "https://api.digitalocean.com/v2/domains";
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
              foreach ($decoderesponse['domains'] as $domain) {
                $name = $domain['name'];
                $status = $domain['ttl'];
                $size_slug = $domain['zone_file'];
                echo "<tr><td>" . $name . "</td>";
                echo "<td>" . $status . "</td>";
                echo "<td>" . $size_slug . "</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <script type="text/javascript">
          $(document).ready(function() {
              $('#digitaloceantable').DataTable({
                "aaSorting": [],
                "oLanguage": {
                    "sInfo": 'Showing _START_ to _END_ of _TOTAL_ domains.',
                    "sInfoEmpty": 'No domains yet.',
                    "sInfoFiltered": 'filtered from _MAX_ total domains',
                    "sZeroRecords": 'No domains Found',
                    "sLengthMenu": 'Show _MENU_ domains',
                    "sEmptyTable": "No domains found currently.",
                  }
                });
              });
          </script>
          <div class="collapse" id="collapseDeveloperMode">
            <div class="well">
              <?php
                echo "<pre>";
                print_r(json_decode($response, 1));
                echo "</pre>";
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
