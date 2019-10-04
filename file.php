<?php
//custom file class representing a file to be stored
class File {
    public $filename;
    public $filePath;
    public $fileType;
    public $fileImgPath;
    public $id;
    public $filesize;

    function __construct($filename, $filePath, $idCount, $filesize){
        $this->filename = $filename;
        $this->filePath = $filePath;
        
        //check to see if valid file type, create new variable for image type
        $this->fileType = strtoupper(end(explode(".", $this->filename)));
        $this->fileImgPath = $this->checkFileType(strtolower($this->fileType));
        $this->id = $idCount;
        $this->filesize = $filesize;
    }
   
    //returns the filename
    function getFilename(){
        return $this->filename;
    }
    //return the filepath
    function getFilePath(){
        return $this->filePath;
    }
    //returns the file extension in all uppercase
    function getFileType(){
        return $this->fileType;
    }
    //return the unique file ID
    function getFileId(){

        return $this->id;
    }

    //returns the file size in bytes
    function getFilesize(){
        return filesize($this->filePath);
    }
    //returns a formated string of the file size in Kilobytes
    function getFormatFileSize(){
        $kbSize = filesize($this->filePath)/1000;
        return sprintf("%0.2f KB", $kbSize);
    }

    //function to generate the html list representaion of a file
    function generateFile(){
        echo sprintf("<tr>
                        <th id=\"%s\" class=\"file-item\"><img src=\"./assets/icons/%s.png\" alt=\"file\">%s</th>
                        <th class=\"kind\">%s</th>
                        <th class=\"size\">%s<div id=\"%s\" class=\"delete-file\"></div></th>
                    </tr>",
                    htmlentities($this->id),
                    htmlentities($this->fileImgPath),
                    htmlentities($this->filename),
                    htmlentities($this->fileType),
                    htmlentities($this->getFormatFileSize()),
                    htmlentities($this->id)

                );
    }
    //function to see if the file types icons is represented, defaults to plain file if not found in the list of the file types supported
    function checkFileType($filename){
        $fileTypesSupported = array("pdf", "doc", "docx", "jpg", "jpeg", "ppt", "js", "xls", "css", "png", "xml", "zip", "json", "txt", "mp3", "csv", "mp4", "psd", "svg", "avi", "exe", "iso", "rtf", "dbf", "ai", "html", "fla", "dwg", "file");
        foreach($fileTypesSupported as $key => $value){
            if($filename == (string)$value){
                return $filename;
            }
        }
        return "file";
    }
}

?>