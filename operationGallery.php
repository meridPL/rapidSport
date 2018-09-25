<?php
    // echo 'test';
    $operacja = $_POST['operacja'];

    if($operacja == 'wczytaj'){

        $div = null;
        for($i = 1; $i < 9; $i++){
            $div .= "
            <div class='img img-test' data-number='{$i}'>
            <span class='fas fa-plus fa-7x'></span>
            </div>
            ";
        }
        
        $tab['div'] = $div;
        echo json_encode($tab);
    }else if($operacja == 'dodaj'){
        print_r($_POST);
        print_r($_FILES);

        $name = $_FILES['zd']['name'][0];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["zd"]["name"][0]);

        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");

        // Check extension
        // if( in_array($imageFileType,$extensions_arr) ){
        
        // Insert record
            // $query = "insert into images(name) values('".$name."')";
            // mysqli_query($con,$query);
            
            // Upload file
            move_uploaded_file($_FILES['zd']['tmp_name'][0],$target_dir.$name);
        // }
    }
?>