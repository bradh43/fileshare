<?php 
    include("file.php");
 
    //recursive function so it can support folders for future development
    function loadFiles($folder, $files, $idCount){
        
        $folderFiles = scandir($folder);
        foreach($folderFiles as $file){
            //make sure the file is not a hidden file
            if(!($file == "." || $file == "..")){
                //check if the file is a directory, and if it is make recursive call
                if(is_dir($file)) {
                    loadFiles($file, $files, $idCount);
                } else {
                    //create a new file to be added to the array of user files
                    $path=$folder."/".$file;
                    $size = filesize($path);
                    $tempFile = new File($file, $path, $idCount, $size);
                    array_push($files, $tempFile, $idCount);
                    $idCount++;
                }
            } 
        }
        return $files;
    }

    function renderFiles($files){
        //check which sorting method to display files with
        $sortMethod = $_SESSION["sortFilesMethod"];
        switch($sortMethod){
            case "kind":
                $files = insertionSort($files, "kind");
                break;
            case "kind-reverse":
                $files = reverseArray(insertionSort($files, "kind"), 0, count($files)-2);
                break;
            case "size":
                $files = insertionSort($files, "size");
                break;
            case "size-reverse":
                $files = reverseArray(insertionSort($files, "size"), 0, count($files)-2);
                break;
            case "name-reverse":
                $files = reverseArray(insertionSort($files, "name"), 0, count($files)-2);
                break;
            case "name":
            default:
                $files = insertionSort($files, "name");
                break;

        }
        //generate and display all the user files
        for($i=0; $i<count($files); $i+=2){
            echo($files[$i]->generateFile());
        }
        return $files;
    }

    //function that returns a boolean value by a comparison made based off the sort selected
    function compareType($files, $sort, $i, $j){
        switch($sort){
            case "kind":
                return $files[$i]->getFileType() < $files[$j]->getFileType();
                break;
            case "size":
                return $files[$i]->getFileSize() < $files[$j]->getFileSize();
                break;
            case "name":
            default:
                return strtolower($files[$i]->getFilename()) < strtolower($files[$j]->getFilename());
                break;
        }
    }

    //insertion sorting algorithm for sorting array of files by a given sort method
    /*
    * The following sorts are supported: kind, name, size
    */
    function insertionSort($files, $sort){
        for($i=2; $i < count($files); $i=$i+2){
            for($j=0; $j<$i; $j=$j+2){
                if(compareType($files, $sort, $i, $j)){
                    $files = swap($files, $i, $j);
                }
            }
        }
        return $files;
    }

    //function to reverse an array for when a user chooses the same sort type twice
    function reverseArray($array, $start, $end){
        if($start < $end){
            $array = swap($array, $end, $start);
            return reverseArray($array, $start+2, $end-2);
        }
        return $array;
    }
    
    //function to swap two files in a files array
    function swap($array, $pos1, $pos2){
        $temp = $array[$pos1];
        $array[$pos1] = $array[$pos2];
        $array[$pos2] = $temp;
        $temp = $array[$pos1+1];
        $array[$pos1+1] = $array[$pos2+1];
        $array[$pos2+1] = $temp;
        return $array;
    }

?>
