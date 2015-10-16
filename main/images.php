  <?php require_once '../main/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
      <?php require_once '../main/sidebar.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main do-images">
          <table id="digitaloceantable" class="table table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Distribution</th>
                <th>Slug</th>
                <th>Public</th>
                <th>Regions</th>
                <th>Min&nbsp;Disk&nbsp;Size</th>
                <th>Created</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $endpoint = "https://api.digitalocean.com/v2/images?private=true";
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
              foreach ($decoderesponse['images'] as $image) {
                $id = $image['id'];
                $name = $image['name'];
                $type = $image['type'];
                $distribution = $image['distribution'];
                $slug = $image['slug'];
                $public = $image['public'];
                $regions = $image['regions'];
                $min_disk_size = $image['min_disk_size'];
                $created_at = $image['created_at'];
                echo "<tr><td>" . $id . "</td>";
                echo "<td>" . $name . "</td>";
                echo "<td>" . $type . "</td>";
                echo "<td>" . $distribution . "</td>";
                echo "<td>" . $slug . "</td>";
                echo "<td>";
                if ($public == true) {
                  echo "Public";
                } else {
                  echo "Private";
                }
                echo "</td>";
                echo "<td>" . $regions[0] . "</td>";
                echo "<td>" . $min_disk_size . "GB</td>";
                echo "<td>" . $created_at . "</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <script type="text/javascript">
          $(document).ready(function() {
              $('#digitaloceantable').DataTable({
                "aaSorting": [],
                "oLanguage": {
                    "sInfo": 'Showing _START_ to _END_ of _TOTAL_ Images.',
                    "sInfoEmpty": 'No Images yet.',
                    "sInfoFiltered": 'filtered from _MAX_ total Images',
                    "sZeroRecords": 'No Images Found',
                    "sLengthMenu": 'Show _MENU_ Images',
                    "sEmptyTable": "No Images found currently.",
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
