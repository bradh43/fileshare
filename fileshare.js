//make sure the window has loaded to make sure action listener can be assigned to an element that exists
window.onload = function () {
    document.getElementById("upload").addEventListener('click', function () {
        document.getElementById("upload-file").click();        
    });
    document.getElementById("confirm-upload").addEventListener('click', function () {
        document.getElementById("upload-form").submit();       
    });
    document.getElementById("confirm-upload").addEventListener('click', function () {
        document.getElementById("upload-form").submit();       
    });
    var deleteButtons = document.getElementsByClassName("delete-file");
    for(button=0; button<deleteButtons.length; button++){
        deleteButtons[button].addEventListener('click', function () {
            if(confirm("Are you sure you want to delete this file?")){
                document.getElementById("delete-file-path").value = this.id;
                document.getElementById("delete-file").submit();       

            }
        });
    }
    var fileItems = document.getElementsByClassName("file-item");    
    if(fileItems.length <= 0){
        document.getElementById("file-list-message").className = "";
        document.getElementById("file-table").className = "hidden";

    } else {
        document.getElementById("file-list-message").className = "hidden";
        document.getElementById("file-table").className = "";
        for(file=0; file<fileItems.length; file++){
            fileItems[file].addEventListener('click', function () {
                document.getElementById("view-file-path").value = this.id;                
                document.getElementById("view-file").submit();       
    
            });
        }
    }

    document.getElementById("name-header").addEventListener('click', function () {
        if(document.getElementById("sort-method").value == "name"){
            document.getElementById("sort-method").value = "name-reverse";
        } else {
            document.getElementById("sort-method").value = "name";
        }
        document.getElementById("sort-method-form").submit();       
    });
    document.getElementById("kind-header").addEventListener('click', function () {
        if(document.getElementById("sort-method").value == "kind"){
            document.getElementById("sort-method").value = "kind-reverse";
        } else {
            document.getElementById("sort-method").value = "kind";
        }
        document.getElementById("sort-method-form").submit(); 
    });
    document.getElementById("size-header").addEventListener('click', function () {
        if(document.getElementById("sort-method").value == "size"){
            document.getElementById("sort-method").value = "size-reverse";
        } else {
            document.getElementById("sort-method").value = "size";
        }
        document.getElementById("sort-method-form").submit(); 
    });
    
    
}

//function to update file that us about to be uploaded to the site
function updateFile(){
   //get the filename
   var fileName = document.getElementById("upload-file").value.split("\\").pop().trim();
   //check if the filename is blank
   if(fileName === ""){
       document.getElementById("upload-file-name").innerHTML = "No File Uploaded";
       document.getElementById("file-type-image").src = "./assets/icons/upload.png";
       document.getElementById("confirm-upload").className = "confirm-upload hidden";
       document.getElementById("choose-file").innerHTML = "Choose File";
   } else {
        document.getElementById("choose-file").innerHTML = "Choose Different File";
        document.getElementById("upload-file-name").innerHTML = document.getElementById("upload-file").value.split("\\").pop();
        var fileType = getFileType(fileName);  
        //check if the file type has a icon to be displayed  
        if(checkFileTypeImageSupported(fileType)){
            document.getElementById("file-type-image").src = "./assets/icons/" + fileType.toLowerCase() + ".png";
        } else {
            //default the file icon to plain file if not supported
            document.getElementById("file-type-image").src = "./assets/icons/file.png";
        }
        document.getElementById("confirm-upload").className = "confirm-upload";
   }
}
//function that returns the file type or extension that a file has 
function getFileType(fileName){
    var type = "";
    for(var i = fileName.length; i > 0; i--) {
        var letter = fileName.charAt(i);
        if(letter === '.'){
            return type
        } else {
            type = letter + type;
        }
    }
    //default to plain file if no extension found
    return "file";
}
//function to check if a given file type has a supporting icon
function checkFileTypeImageSupported(fileType) {
    var fileTypesSupported = ["pdf", "doc", "docx", "jpg", "jpeg", "ppt", "js", "xls", "css", "png", "xml", "zip", "json", "txt", "mp3", "csv", "mp4", "psd", "svg", "avi", "exe", "iso", "rtf", "dbf", "ai", "html", "fla", "dwg", "file"];
    for (type in fileTypesSupported){        
        if(fileType === fileTypesSupported[type]){            
            return true;
        }
    }
    return false;
}

