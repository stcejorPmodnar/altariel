<?php
    $lat = $_POST['latitude'];
    $long = $_POST['longitude'];
    $folderName = $_POST['fileName'];
if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){


    #GET ALTITUDE using a post request to jawglab
    // $json = file_get_contents("https://api.jawg.io/elevations?locations=$lat,$long&access-token=SBoWI0LKukjdjz2FZfE4lRxl9gWRAknp8ND00ZGn6Fp2H0buugWehRu5dgvo7CQu");
    // $json = json_decode($json);
    $alt = file_get_contents("https://api.airmap.com/elevation/v1/ele/?points=$lat,$long");

    # Creates a dir to store the coordinates
    // ======================================
    if (!file_exists( "../$folderName/coordinates" )) {
        mkdir("../$folderName/coordinates");
    }

    # Creates a dir to store the elevation
    // ======================================
    if (!file_exists( "../$folderName/altitude" )) {
        mkdir("../$folderName/altitude");
    }

    if (!file_exists( "../$folderName/distance" )) {
        mkdir("../$folderName/distance");
    }

    if (!file_exists( "../$folderName/speed" )) {
        mkdir("../$folderName/speed");
    }

    if (!file_exists( "../$folderName/dist-cumulative" )) {
        mkdir("../$folderName/dist-cumulative");
    }

    if (!file_exists( "../$folderName/calories" )) {
        mkdir("../$folderName/calories");
    }

    $iterNum = preg_replace('/\s+/', '', shell_exec("ls ../$folderName/distance/ | wc -l | tr -d ' ' "));

    $latOld = "../$folderName/coordinates/$iterNum-lat.txt";
    $longOld = "../$folderName/coordinates/$iterNum-long.txt";
    $altOld = "../$folderName/altitude/$iterNum.txt";

    // $altNew = $json[0]->elevation;
    $altNew = $_POST['altitude'];

    if ( $iterNum == 0 ) {
        file_put_contents("../$folderName/distance/1.txt", "0");
        file_put_contents("../$folderName/speed/1.txt", "0");
        file_put_contents("../$folderName/dist-cumulative/dist.txt", "0");
        file_put_contents("../$folderName/calories/total.txt", "0");

        $distanceContent = 0;
        $speed = 0;
        $putDist = 0;
        $putCal = 0;
    }
    else {
        $distName = "$folderName/distance/";
        $distanceContent = preg_replace('/\s+/', '', shell_exec("../analysis/continual/distance.sh $latOld $longOld $altOld $lat $long $altNew"));
        shell_exec("../filecreator.sh $distName $distanceContent");

        //Delete:
        // echo "In the last measurement you traveled $distanceContent meters<br>";

        $existDist = file_get_contents("../$folderName/dist-cumulative/dist.txt");
        $putDist = $existDist + $distanceContent;
        file_put_contents("../$folderName/dist-cumulative/dist.txt", $putDist);

        //Delete:
        // echo "In total you traveled $putDist meters<br>";

        $speedName = "$folderName/speed/";
        $speed = shell_exec("python3 ../analysis/continual/speed.py $distanceContent");
        shell_exec("../filecreator.sh $speedName $speed");

        $calorieOpt = $_POST['calorieOpt'];
        //Delete:
        // echo "You are going at $speed mph<br>";

        $calName = "$folderName/calories/";
        $calories = preg_replace('/\s+/', '', shell_exec("python3 ../analysis/continual/calories.py $calorieOpt $speed"));
        $total = file_get_contents("../$folderName/calories/total.txt");
        $putCal = $total + $calories;
        file_put_contents("../$folderName/calories/total.txt", $putCal);

    }

    # Creates new file with name of num of coords + 1
    #=================================================
    $fileName = "$folderName/coordinates/";
    $coordContent = "$lat";
    $coordContent2 = $long;

    shell_exec("../filecreator.sh $fileName $coordContent $coordContent2");

    # Creates new file with name of num of altitudes + 1
    #===================================================
    $altFileName = "$folderName/altitude/";
    #$altContent = $json[0]->elevation;
    $altContent = $_POST['altitude'];

    shell_exec("../filecreator.sh $altFileName $altContent");

    #now it has to return arrays with coords, speed, etc etc etc
    $altArray = shell_exec("../array-maker.sh ../$folderName/altitude/");

    $speedArray = shell_exec("../array-maker.sh ../$folderName/speed/");

    $returnArray = "{\"altitude\":$altArray, \"speedArray\":$speedArray, \"coordinates\":[$lat,$long], \"currentSpeed\":$speed, \"totalDist\":$putDist, \"calories\":$putCal}";
    echo $returnArray;

}

?>