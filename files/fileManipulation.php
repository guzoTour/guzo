<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Manipulation</title>
</head>
<body>
   <div>
    <form action="" method="get">
        <h1>Create Folder</h1>
        <?php    echo "Your current directory is:  ".getcwd();?>
        <br>
        <label for="path">Path</label>
        <input type="text" name = "path1"><br>
        <label for="path">New Folder Name</label>
        <input type="text" name = "folder1"><br>
        <button type="submit" name = "actions" value = "createdir">Submit</button>    
    </form>
    
    <form action="" method="get">
        <h1>Delete Folder</h1>
        <?php    echo "Your current directory is:  ".getcwd();?>
        <br>
        <label for="path">Path</label>
        <input type="text" name = "path2"><br>
        <label for="path">Folder Name</label>
        <input type="text" name = "folder2"><br>
        <button type="submit" name = "actions" value = "deletedir">Submit</button>    
    </form>
    <form action="" method="get">
        <h1>Create File</h1>
        <?php    echo "Your current directory is:  ".getcwd();?>
        <br>
        <label for="path">Path</label>
        <input type="text" name = "path3"><br>
        <label for="path">File Name</label>
        <input type="text" name = "file1"><br>
        <button type="submit" name = "actions" value = "createfile">Submit</button>    
    </form>
    <form action="" method="get">
        <h1>Change file folder</h1>
        <?php    echo "Your current directory is:  ".getcwd();?>
        <br>
        <label for="path">Orgin Folder Name</label>
        <input type="text" name = "path4"><br>
        <label for="path">Destination  Folder Name</label>
        <input type="text" name = "path5"><br>
        <label for="path">File Name</label>
        <input type="text" name = "file2"><br>
        <button type="submit" name = "actions" value = "changefilepath">Submit</button>    
    </form>
    <form action="" method="get">
        <h1>Write file</h1>
        <?php    echo "Your current directory is:  ".getcwd();?>
        <br>
        <label for="path">Folder Name</label>
        <input type="text" name = "path7"><br>
        <label for="path">File Name</label>
        <input type="text" name = "file4"><br>
        <label for="path">Data</label>
        <input type="text" name = "data"><br>
        <button type="submit" name = "actions" value = "writefile">Submit</button>    
    </form>
    <form action="" method="get">
        <h1>Read file</h1>
        <?php    echo "Your current directory is:  ".getcwd();?>
        <br>
        <label for="path">Folder Name</label>
        <input type="text" name = "path8"><br>
        <label for="path">File Name</label>
        <input type="text" name = "file5"><br>
        <label for="path"><?php function take($data){
                echo $data;
        }
     ?></label><br>
        <button type="submit" name = "actions" value = "readfile">Submit</button>    
    </form>
    <form action="" method="get">
        <h1>Delete file</h1>
        <?php    echo "Your current directory is:  ".getcwd();?>
        <br>
        <label for="path">Folder Name</label>
        <input type="text" name = "path6"><br>
        <label for="path">File Name</label>
        <input type="text" name = "file3"><br>
        <button type="submit" name = "actions" value = "deletefile">Submit</button>    
    </form>
    </div>
    <style>
        body{
            display:flex;
            justify-content:center;   
        }
    </style>
</body>
</html>
<?php

if(isset($_GET["actions"])){
    if($_GET["actions"]=="createdir"){
        $folder_name = $_GET["folder1"];
        $path_name = $_GET["path1"];
        chdir($path_name);
        mkdir($folder_name);
    }
    else if($_GET["actions"]=="deletedir"){
        $folder_name = $_GET["folder2"];
        $path_name = $_GET["path2"];
        chdir($path_name);
        rmdir($folder_name);
    }
    else if($_GET["actions"]=="createfile"){
        $file_name = $_GET["file1"];
        $path_name = $_GET["path3"];
        chdir($path_name);
         $file = fopen ($file_name, "a");
         if (!$file) {
             echo "<p>Unable to open remote file.\n";
             exit;
         }
        else{
            fclose($file);
            echo "The ".$file_name." is created";
         }     
    }
    else if($_GET["actions"]=="changefilepath"){
        $file_name = $_GET["file2"];
        $path_name_orgin = $_GET["path4"];
        $path_name_destination = $_GET["path5"];

        if(rename($path_name_orgin."/".$file_name, $path_name_destination."/".$file_name)){
            echo "The file is  moved succeffuly";
        }
        else{
            echo "The is error";
        }
        
    }
    else if($_GET["actions"]=="deletefile"){
        $file_name = $_GET["file3"];
        $path_name = $_GET["path6"];
        chdir($path_name);
        if(unlink($file_name)){
            echo "The file ".$file_name." is deleted successfully";
        }
        else{
            echo "There file is error";
         }
    } 
    else if($_GET["actions"]=="writefile"){
        $file_name = $_GET["file4"];
        $path_name = $_GET["path7"];
        $data = $_GET["data"];
        chdir($path_name);
        $file = fopen ($file_name, "a");
         if( $file == false ) {
            echo ( "Error in opening new file" );
            exit();
         }
         else{
             fwrite( $file, $data);
             fclose($file);
         }
    }
    else if($_GET["actions"]=="readfile"){
        $file_name = $_GET["file5"];
        $path_name = $_GET["path8"];
        chdir($path_name);
        $file = fopen ($file_name, "r");
        
        if(!is_readable($file_name)){
            echo ( "Error in opening new file" );
                exit();
        }
        else{
            $filesize = filesize($file_name);
            $filetext = fread( $file, $filesize);
            take($filetext);
            
        }

    }
}

?>