  <?php require_once '../main/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
      <?php require_once '../main/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main do-droplets">
          <table id="digitaloceantable" class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Memory</th>
                <th>Disk</th>
                <th>IP</th>
                <th>Location</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $endpoint = "https://api.digitalocean.com/v2/droplets";
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
              foreach ($decoderesponse['droplets'] as $droplet) {
                $name = $droplet['name'];
                $status = $droplet['status'];
                $size_slug = $droplet['size_slug'];
                $disk = $droplet['disk'];
                $ipaddress = $droplet['networks']['v4'][0]['ip_address'];
                $region = $droplet['region']['name'];
                echo "<tr><td>" . $name . "</td>";
                echo "<td>" . $status . "</td>";
                echo "<td>" . $size_slug . "</td>";
                echo "<td>" . $disk . "GB</td>";
                echo "<td>" . $ipaddress . "</td>";
                echo "<td>" . $region . "</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <script type="text/javascript">
          $(document).ready(function() {
              $('#digitaloceantable').DataTable({
                "aaSorting": [],
                "oLanguage": {
                    "sInfo": 'Showing _START_ to _END_ of _TOTAL_ Droplets.',
                    "sInfoEmpty": 'No Droplets yet.',
                    "sInfoFiltered": 'filtered from _MAX_ total Droplets',
                    "sZeroRecords": 'No Droplets Found',
                    "sLengthMenu": 'Show _MENU_ Droplets',
                    "sEmptyTable": "No Droplets found currently.",
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
        <?php endif;?>
        </div>
      </div>
    </div>
  </body>
</html>
