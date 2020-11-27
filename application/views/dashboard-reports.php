    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawVisualization);
                
        function drawVisualization() {
          // Some raw data (not necessarily accurate)
          var data = google.visualization.arrayToDataTable([
            ['Month', 'Subscribers'],
              <?php
                foreach($report as $r) {
                    echo "['{$r['month']}', {$r['number']}],";
                }
              ?>
          ]);

          var options = {
            title : 'Monthly Subscribers In <?=$preselect_year;?>',
            vAxis: {title: "People"},
            hAxis: {title: "Month"},
            seriesType: "bars",
            series: {5: {type: "line"}}
          };

          var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
          chart.draw(data, options);
        }
    </script>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reports</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
                <div class="col-lg-12">
                    <!--breadcrumb-->
                    <ol class="breadcrumb">
                        <li><a href="<?=  site_url('dashboard');?>">Dashboard</a></li>
                        <li>Reports</li>
                      </ol>
                    <!--e breadcrumb-->
                    
                    <div class="col-lg-8">
                        <?php
                        
                        if ($years == null)
                            echo 'Sorry, you don\'t have any subscribers yet.';
                        else { 
                            echo '<select class="form-control" id="year">';
                            foreach($years as $year) {
                        ?>
                            
                            
                        <option <?=(($preselect_year == $year['year'])? 'selected' : '')?> value="<?=$year['year'];?>"><?=$year['year'];?></option>

                        <?php
                            }
                            echo '</select>';
                        }
                        
                        if ($report == null)
                            echo 'Sorry, temporary no report at the year.';
                        ?>
                        
                        <div id="chart_div" style="width: 900px; height: 500px;"></div>

                        
                    </div>
                </div>
        </div>
    <script type="text/javascript">
        $('#year').change(function() {
            //alert(base_url);
            location.href = base_url+'reports/subscriptions/'+$(this).val();
        });
    </script>