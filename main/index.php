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
        <a class="navbar-brand" href="../main/index.php">Digital Ocean Dashboard</a>
      </div>
      <ul class="tab__content">
        <ul class="colors">
          <li data-color="#2ecc71"></li>
          <li data-color="#d64a4b"></li>
          <li data-color="#8e44ad"></li>
          <li data-color="#46a1de"></li>
          <li data-color="#ff76ea"></li>
          <li data-color="#fff"></li>
        </ul>
      </ul>
      <button class="btn btn-small" type="button" data-toggle="collapse" data-target="#collapseDeveloperMode" aria-expanded="false" aria-controls="collapseDeveloperMode">
        Developer Mode
      </button>
    </div>
  </nav>
  <?php require_once(__DIR__ . '/../config.php'); ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 main">
          <div class="clearfix">&nbsp;</div>
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
                curl_setopt_array( $curl, [
                  CURLOPT_HTTPHEADER     => $headers,
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_URL            => $endpoint,
                ]);
                $response = curl_exec( $curl );
                $decoderesponse = json_decode( $response, true );
                foreach ($decoderesponse['droplets'] as $droplet ) {
                  $name = $droplet['name'];
                  $status = $droplet['status'];
                  $size_slug = $droplet['size_slug'];
                  $disk = $droplet['disk'];
                  $ipaddress = $droplet['networks']['v4'][0]['ip_address'];
                  $region = $droplet['region']['name'];
                  echo "<tr><td>" . $name . "</td>";
                  echo "<td>" . $status. "</td>";
                  echo "<td>" . $size_slug . "</td>";
                  echo "<td>" . $disk . "gb</td>";
                  echo "<td>" . $ipaddress . "</td>";
                  echo "<td>" . $region . "</td></tr>";
                }
                ?>
              </tbody>
            </table>
          <script type="text/javascript">
          $(document).ready(function() {
              jQuery('#digitaloceantable').DataTable({
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
          <div class="collapse" id="collapseDeveloperMode">
            <div class="well">
              <?php
                echo "<pre>";
                print_r(json_decode( $response, 1 ) );
                echo "</pre>";
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
