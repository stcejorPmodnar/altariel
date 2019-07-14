<?php
    $lat = $_POST['latitude'];
    $long = $_POST['longitude'];
    $folderName = $_POST['fileName'];
if(!empty($_POST['latitude']) && !empty($_POST['longitude'])){


    #GET ALTITUDE using a post request to jawglab
    $json = file_get_contents("https://api.jawg.io/elevations?locations=$lat,$long&access-token=SBoWI0LKukjdjz2FZfE4lRxl9gWRAknp8ND00ZGn6Fp2H0buugWehRu5dgvo7CQu");
       
    $json = json_decode($json);


    # Creates a dir to store the coordinates
    // ======================================
    if (!file_exists( "../loc-data" )) {
        mkdir("../loc-data");
    }

    if (!file_exists( "../$folderName/coordinates" )) {
        mkdir("../$folderName/coordinates");
    }

    # Creates a dir to store the elevation
    // ======================================
    if (!file_exists( "../$folderName/altitude" )) {
        mkdir("../$folderName/altitude");
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
    $altContent = $json[0]->elevation;

    shell_exec("../filecreator.sh $altFileName $altContent");


    #now it has to return arrays with coords, speed, etc etc etc

    // echo "$coordContent";

    $altArray = shell_exec("../array-maker.sh ../$folderName/altitude/");
    // echo "$altArray";


    // echo "$long,$lat";
    $returnArray = "{\"altitude\":$altArray,\"coordinates\":[$lat,$long]}";
    echo $returnArray;

}

?>