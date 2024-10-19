<?php
    session_start();
  

        if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['path'])){
            $pathSaisi = $_POST['path'];

                if(is_dir($pathSaisi)){
                    $files = scandir($pathSaisi);
                    $files = array_diff($files, array('.','..'));
                }

        }

        
    
    

    
    
   