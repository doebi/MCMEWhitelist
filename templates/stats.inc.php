    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.load('visualization', '1', {'packages': ['geochart']});
      google.setOnLoadCallback(drawChart);
      <?php
      	$accepted = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE accepted = '1'"), 0);
      	$rejected = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE reviewed = '1' AND accepted = '0' AND correct = '1'"), 0);
      	$pending = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE reviewed = '0' AND correct = '1'"), 0);
      	$incorrect = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE correct = '0'"), 0);
      	$totalApplies = $accepted + $incorrect + $pending + $rejected;
      	$totalAccepted = $accepted;
      	$question1a = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE question1 = '0'"), 0);
      	$question2a = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE question2 = '0'"), 0);
      	$question3a = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE question3 = '0'"), 0);;
      	$question1b = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE question1 = '1'"), 0);
      	$question2b = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE question2 = '1'"), 0);
      	$question3b = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE question3 = '1'"), 0);
      	$question1c = 0;
      	$question2c = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE question2 = '2'"), 0);
      	$question3c = 0;
      ?>
      function drawChart() {
        var incorrectdata = google.visualization.arrayToDataTable([
          ['Question', 'Answer 1', 'Answer 2', 'Answer 3'],
          ['Question 1', <?php echo $question1a; ?>, <?php echo $question1b; ?>, <?php echo $question1c; ?>],
          ['Question 2', <?php echo $question2a; ?>, <?php echo $question2b; ?>, <?php echo $question2c; ?>],
          ['Question 3', <?php echo $question3a; ?>, <?php echo $question3b; ?>, <?php echo $question3c; ?>]
        ]);
        
        var appdata = google.visualization.arrayToDataTable([
          ['Status', 'Amount'],
          ['Accepted', <?php echo $accepted; ?>],
          ['Rejected', <?php echo $rejected; ?>],
          ['Incorrect', <?php echo $incorrect; ?>],
          ['Pending', <?php echo $pending; ?>]
        ]);

       	var timeappdata = google.visualization.arrayToDataTable([
          ['Month', 'Accepted', 'Rejected', 'Incorrect'],       
	      <?php
	      	//$months = array("September 2012", "October 2012", "November 2012", "December 2012", "January 2013");
	      	$months = array("September 2012", "October 2012", "November 2012", "December 2012");
	      	$time = array("1346457600", "1349049600", "1351728000", "1354320000", "1356998400", "1359676800");
	      	foreach($months as $index => $month){
	      		$starttime = $time[$index];
	      		$index++;
	      		$endtime = $time[$index];
		      	$accepted = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE accepted = '1' AND applytime > '$starttime' AND applytime < '$endtime'"), 0);
		      	$rejected = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE reviewed = '1' AND accepted = '0' AND correct = '1' AND applytime > '$starttime' AND applytime < '$endtime'"), 0);
		      	$pending = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE reviewed = '0' AND correct = '1' AND applytime > '$starttime' AND applytime < '$endtime'"), 0);
		      	$incorrect = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE correct = '0' AND applytime > '$starttime' AND applytime < '$endtime'"), 0);
		      	echo "['".$month."', ".$accepted.", ".$rejected.", ".$incorrect."],";
	      	}
	      ?>]);

       	var agedata = google.visualization.arrayToDataTable([
          ['Year', 'Accepted', 'Rejected', 'Incorrect'],       
	      <?php
	      	$maxyear = $year=date("Y");
	      	$averAge = 0;
	      	for ($i = 1960; $i < $maxyear; $i++) {
		      	$accepted = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE birth = '$i' AND accepted = '1'"), 0);
		      	$rejected = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE birth = '$i' AND reviewed = '1' AND accepted = '0' AND correct = '1'"), 0);
		      	$incorrect = mysql_result(mysql_query("SELECT COUNT(*) FROM applies WHERE birth = '$i' AND correct = '0'"), 0);
		      	$year = $maxyear - $i;
		      	echo "['Age ".$year."', ".$accepted.", ".$rejected.", ".$incorrect."],";
		      	$averAge = $averAge + ($accepted*$year);
	      	}
	      ?>]);
        
        var timeoffdata = google.visualization.arrayToDataTable([
          <?php
          $officers = mysql_query("SELECT username FROM officers");
          echo "['Officer'";
          while ($row = mysql_fetch_assoc($officers)){
          	$name = $row['username'];
		      	echo ", '".$name."'";
          }
          echo "],";
	      	foreach($months as $index => $month){
	      		$starttime = $time[$index];
	      		$index++;
	      		$endtime = $time[$index];
	          echo "['".$month."', ";
	          $officers = mysql_query("SELECT username FROM officers");
	          while ($row = mysql_fetch_assoc($officers)){
	          	$name = $row['username'];
	          	$count = mysql_result(mysql_query("SELECT COUNT(officer) FROM applies WHERE officer = '$name' AND applytime > '$starttime' AND applytime < '$endtime'"), 0);
			      	echo $count.", ";
	          }
	          echo "],";
	        }
          ?>]);
        
        var offdata = google.visualization.arrayToDataTable([
          ['Officer', 'Amount'],
          <?php
          $officers = mysql_query("SELECT username FROM officers");
          while ($row = mysql_fetch_assoc($officers)){
          	$name = $row['username'];
          	$count = mysql_result(mysql_query("SELECT COUNT(officer) FROM applies WHERE officer = '$name'"), 0);
          	echo "['".$name."', ".$count."],";
          }
          ?>]);
        
        var geoappliesdata = google.visualization.arrayToDataTable([
          ['Country', 'Amount'],
          <?php
          $countries = mysql_query("SELECT DISTINCT country FROM applies");
          while ($row = mysql_fetch_assoc($countries)){
          	$cc = $row['country'];
          	if($cc != "XX"){
	          	$count = mysql_result(mysql_query("SELECT COUNT(username) FROM applies WHERE country = '$cc'"), 0);
	          	echo "['".$cc."', ".$count."],";
	          }
          }
          ?>]);

        var appoptions = {
          title: 'Minecraft Middle-Earth Applications',
          backgroundColor: '#F4F8E7',
          is3D: 'true'
        };

        var incorrectoptions = {
          title: 'Count of Answers',
          backgroundColor: '#F4F8E7',
          isStacked: 'true'
        };

        var ageoptions = {
          title: 'Age of Applicants',
          backgroundColor: '#F4F8E7',
          isStacked: 'true'
        };

        var timeappoptions = {
          title: 'Minecraft Middle-Earth Applications in the Past',
          backgroundColor: '#F4F8E7',
          isStacked: 'true'
        };

        var timeoffoptions = {
          title: 'Reviews per Admission Officer in the Past',
          backgroundColor: '#F4F8E7'
        };
        
        var offoptions = {
          title: 'Reviews per Admission Officer',
          backgroundColor: '#F4F8E7',
          is3D: 'true'
        };

        var geoappliesoptions = {
          backgroundColor: '#F4F8E7'
        };

        var appchart = new google.visualization.PieChart(document.getElementById('apps'));
        appchart.draw(appdata, appoptions);

        var agechart = new google.visualization.AreaChart(document.getElementById('age'));
        agechart.draw(agedata, ageoptions);
        
        var offchart = new google.visualization.PieChart(document.getElementById('officers'));
        offchart.draw(offdata, offoptions);
        
        var timeappschart = new google.visualization.AreaChart(document.getElementById('timeapps'));
        timeappschart.draw(timeappdata, timeappoptions);
        
        var timeofficerchart = new google.visualization.BarChart(document.getElementById('timeofficers'));
        timeofficerchart.draw(timeoffdata, timeoffoptions);
        
        var incorrectchart = new google.visualization.BarChart(document.getElementById('incorrect'));
        incorrectchart.draw(incorrectdata, incorrectoptions);
        
        var geoapplieschart = new google.visualization.GeoChart(document.getElementById('geoapplies'));
        geoapplieschart.draw(geoappliesdata, geoappliesoptions);
      }
    </script>
  </head>
  <body>
  	<center>
	    <div id="apps" style="width: 900px; height: 500px;"></div>
	    <div id="incorrect" style="width: 900px; height: 500px;"></div>
	    <div id="officers" style="width: 900px; height: 500px;"></div>
	    <div id="timeapps" style="width: 900px; height: 500px;"></div>
	    <div id="timeofficers" style="width: 900px; height: 1000px;"></div>
	    <div id="geoapplies" style="width: 900px; height: 500px;"></div>
	    <div id="age" style="width: 900px; height: 500px;"></div>
	    <div style="font-family:'Arial'"><br>
	    	<span>Total Applies: <b><?php echo $totalApplies; ?></b></span><br>
	    	<span>Total Accepted Applies: <b><?php echo $totalAccepted; ?></b></span><br>
	    	<span>Average Age among accepted: <b><?php echo $averAge/$totalAccepted; ?></b></span>
	    </div>
	    <div id="space" style="width: 900px; height: 500px;"></div>
	  </center>
  </body>
