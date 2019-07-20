<!DOCTYPE html>
<html>
    <head>
        <title>Fitness App | Workout In Progress</title>

        <!---===============  FOR STYLSHEETS  =======================-->
        <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
        <link rel="stylesheet" type="text/css" href="../stylesheets/exercise.css">
        <link rel="stylesheet" type="text/css" href="../stylesheets/dashboard.css">

        <!---=============== FOR SETTING THE SCALE =======================-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!---=============== FOR APEXCHARTS LIBRARY =======================-->
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <!---==================== FOR JQUERY ===============================================-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


        <script src="../flipclock/easytimer.min.js"></script>
        <script>
            var timer = new easytimer.Timer();
            timer.start();

            timer.addEventListener('secondsUpdated', function (e) {
                $('#timer').html(timer.getTimeValues().toString());
            });
            timer.addEventListener('started', function (e) {
                $('#timer').html(timer.getTimeValues().toString());
            });
            timer.addEventListener('reset', function (e) {
                $('#timer').html(timer.getTimeValues().toString());
            });

        </script>
    </head>
    <body>

        <?php 
            $trans = $_POST['transport'];
            $focus = $_POST['focus'];

            if ( $trans == "buttonTop1" ) {
                $transEng = "Running";
            }
            else {
                $transEng = "Cycling";
            }

            if ( $focus == "buttonBottom1" ) {
                $focusEng = "Endurance";
            }
            else {
                $focusEng = "Speed";
            }    
        ?>
        <div id="navbar">
            <h2 id="navbar-title"><a href='index.html'><img src='../images/logo-assets/altariel-04.svg' width=130 style='vertical-align:middle;transform:translate(0px, -3px);'></img></a></h2>
            <a href="exercise.html" class="navbar-link-text">
                <h4>Exercise</h4>
            </a>
            <a href="../index.html" class="navbar-link-text">
                <h4>Home</h4>
            </a>
        </div>
        <div id='bumper'></div>

        <div id='workout'>
            <h3 id='workoutText'>
                Workout: <?php echo "$transEng, $focusEng" ?>
            </h3>
        </div>

        <div id=timerDiv>
            <p id='timer'></p>
        </div>

        <div id='infoBoxes'>
            <div class='infoBox'>
                <p id='speedNum' class='infoBoxText big'>0</p>
                <p class='infoBoxText small'>MPH</p>
            </div>
            <div class='infoBox'>
                <p id='distNum' class='infoBoxText big'>0</p>
                <p class='infoBoxText small'>Miles</p>
            </div>
            <div class='infoBox' style='margin-right:0px;'>
                <p id='calNum' class='infoBoxText big'>0</p>
                <p class='infoBoxText small'>Calories</p>
            </div>
        </div>
       
        <div id='graphs'>
            <div class='lineGraph' style='margin-right: 4%;vertical-align:middle' id='graphSpeed'><h3 style='margin-top:8px;'>Speed</h3></div>
            <div class='lineGraph' id='graphAltitude' style='vertical-align:middle'><h3 style='margin-top:8px;'>Altitude</h3></div>
        </div>
        
        <div id='startStopButtons'>
            <button class='breakButton' id='pause' style='margin-right: 6%;' onclick='addPause();timer.pause();'>Pause</button>
            <button class='breakButton' id='stop'>Stop</button>
        </div>
        <p id='coord'></p>

        <script>
            function addPause() {
                // el = document.getElementById('pause');
                // el.innerHTML = 'Start';
                // el.className = "breakButton paused";
                // el.onclick = function() { el = document.getElementById('pause'); el.innerHTML = 'Pause'; el.className = "breakButton"; el.onclick = addPause();}
                document.getElementById('startStopButtons').innerHTML = "<button class='breakButton' id='pause' style='margin-right: 6%;' onclick='removePause();timer.start();'>Resume</button><button class='breakButton' id='stop'>Stop</button>"
                document.getElementById('pause').className += " paused";
                document.getElementById('pause').id = 'resume'
            }

            function removePause() {
                document.getElementById('startStopButtons').innerHTML = "<button class='breakButton paused' id='resume' style='margin-right: 6%;' onclick='addPause();timer.pause();'>Pause</button><button class='breakButton' id='stop'>Stop</button>"
                $("#resume").removeClass('paused');
                document.getElementById('resume').id = 'pause'
            }
        </script>
        
        
        <script>
            var altOptions = {
                chart: {
                    type: 'line',
                    height: 42,
                    sparkline: {
                        enabled: true,
                    }
                },
                series: [{
                    data: [0]
                }],
            }   

            var altChart = new ApexCharts(document.querySelector("#graphAltitude"), altOptions);
            altChart.render();

            //======================================================

            var speedOptions = {
                chart: {
                    type: 'line',
                    height: 42,
                    sparkline: {
                        enabled: true,
                    }
                },
                series: [{
                    data: [0]
                }],
            }   
            var speedChart = new ApexCharts(document.querySelector("#graphSpeed"), speedOptions);
            speedChart.render();

        </script>

        <?php 

            if (!file_exists( "../loc-data" )) {
                mkdir("../loc-data");
            }
        
            $folderNum = shell_exec('../foldermaker.sh');
            $folderNum = preg_replace('/\s+/', '', $folderNum);

            $folderName = "../loc-data/" . "$folderNum" . "_" . "$transEng" . "_" . "$focusEng";
            mkdir($folderName);
            $newFolderName = "loc-data/" . "$folderNum" . "_" . "$transEng" . "_" . "$focusEng";
        ?>
            <script>
                function sleep(ms) {
                    return new Promise(resolve => setTimeout(resolve, ms));
                }

                async function demo() {
                    while (1) {
                        await sleep(2000);
                        $(document).ready(function() {
                            if(navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showLocation);
                            }
                            else { 
                                console.log('Geolocation is not supported by this browser.');
                            }
                            });
                            function showLocation(position) {
                                var latitude = position.coords.latitude;
                                var longitude = position.coords.longitude;
                                // var alt = position.coords.altitude;
                                var alt = 81

                                if (document.getElementById('resume')) {
                                    console.log('paused');
                                }
                                else {
                                // console.log(position.coords.accuracy);
                                    $.ajax({
                                        type:'POST',
                                        url:'locationSaver.php',
                                        data:'altitude='+alt+'&latitude='+latitude+'&longitude='+longitude+'&<?php echo "fileName=$newFolderName"?>',
                                        success:function(msg){
                                            
                                            if ( msg ) {
                                                // msg = JSON.parse(msg);
                                                // console.log(msg);
                                                // altMsg = msg.altitude;
                                                // var options2 = {
                                                //     chart: {
                                                //         height: 80,
                                                //         type: 'line',
                                                //         sparkline: {
                                                //             enabled: true,
                                                //         }
                                                //     },
                                                //     series: [{
                                                //         data: altMsg
                                                //     }]
                                                // }

                                                // altChart.updateOptions(options2)
                                                // document.getElementById('coord').innerHTML = msg;
                                                msg = JSON.parse(msg);
                                                // var meterDist = Math.round( 100 * msg.totalDist ) / 100
                                                var meterDist = msg.totalDist;
                                                var milesDist = 0.000621371 * meterDist;
                                                var roundedMilesDist = Math.round( milesDist * 100 ) / 100
                                                document.getElementById('distNum').innerHTML = roundedMilesDist;

                                                var curSpeed = msg.currentSpeed;
                                                var roundedSpeed = Math.round( curSpeed * 100 ) / 100;
                                                document.getElementById('speedNum').innerHTML = roundedSpeed;
                                            }
                                            else {
                                                console.log('not Available');
                                            }
                                        }
                                    });
                                }
                            }
                    }
                }

                demo();
            </script>
           <!-- <script>

                $(document).ready(function() {
                    if(navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showLocation);
                    }
                    else { 
                        console.log('Geolocation is not supported by this browser.');
                    }
                });
                function showLocation(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    $.ajax({
                        type:'POST',
                        url:'locationSaver.php',
                        data:'latitude='+latitude+'&longitude='+longitude+'&fileNum=5',
                        success:function(msg){
                            if(msg){
                                console.log(msg);
                            }else{
                                console.log('not Available');
                            }
                        }
                    });
                }
            </script> -->

    </body>
</html>
