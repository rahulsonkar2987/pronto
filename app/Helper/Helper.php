<?php  


if(!function_exists('p')){
    function p($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();
    }
}

if(!function_exists('pa')){
    function pa($data){
        echo "<pre>";
        print_r($data->all());
        echo "</pre>";
        die();
    }
}

if(!function_exists('pta')){
    function pta($data){
        echo "<pre>";
        print_r($data->toArray());
        echo "</pre>";
        die();
    }
}


if(!function_exists('pv')){
    function pv($data){
        print($data);
        die();
    }
}

if(!function_exists('e')){
    function e($data){
        echo  $data;
    }
}


if(!function_exists('ln')){
    function ln($value,$text_property=NULL){
        if($text_property=='lcfirst'){ //converts the first character of a string to lowercase
            echo  lcfirst(str_replace('_', ' ',$value));  
        }else if($text_property=='ucfirst'){  
            echo  ucfirst(str_replace('_', ' ',$value));
        }elseif($text_property=='ucwords'){  //converts the first character of each word in a string to uppercase
            echo  ucwords(str_replace('_', ' ',$value));  
        }elseif($text_property=='strtoupper'){  //converts a string to uppercase
            echo  strtoupper(str_replace('_', ' ',$value));  
        }elseif($text_property=='strtolower'){  //converts a string to lowercase
            echo  strtolower(str_replace('_', ' ',$value));  
        }else{
            echo  "<span class='text-danger display-4'>Text Property Wrong</span>";
        }

    }
}


// old and edit value
if(!function_exists('iput')){
    function iput($old=null,$value=null){
            if($old){
                echo $old;
            }else{
                echo $value;
            }
    }
}


if(!function_exists('iputSelect')){
    function iputSelect($old=null,$sv,$value){
        if($old==$sv){
            echo 'selected';
        }elseif($value==$sv){
            echo 'selected';
        }
    }
}

if(!function_exists('iputCheck')){
    function iputCheck($fa,$old,$sv='',$value=''){
        if($fa=='add'){
            if($old==$sv){
                echo 'checked';
            }elseif($old==$sv){
                echo 'checked';
            }
        }elseif($fa=='edit'){
            if($old){
                if($old==$sv){
                    echo 'checked';
                }
            }elseif($sv==$value){
                echo 'checked';
            }
        }
    }
}


if(!function_exists('create_id')){
    function create_id(){
        $acceptedChars = ['2','a','3','b','4','c','5','d','6','e','7','f','8','g','9','h','3','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','1','2','3','4','5','6','7','8','9'];
        $max = count($acceptedChars)-1;
        $code = null;
            for($i=0; $i <=5; $i++) {
            $code .= $acceptedChars[rand(0, $max)];
            }
        $code1 = $code; 
        
        $code = null;
            for($i=0; $i <=5; $i++) {
            $code .= $acceptedChars[rand(0, $max)];
            }
        $code2 = $code;
        $d=date("Ymdshis").time();
        return  ($code1.$code2.$d);
    }
}


// get Attibutes 
if(!function_exists('getAttr')){
    function getAttr($data){
        $array = [];
        foreach ($data->all() as $key => $value) {
            if($key=='password'){
                $array[$key] = bcrypt($value);
            }else{
                $array[$key] = $value;
            }
        }
        return $array;
    }
}

///image upload
if(!function_exists('image')){
    function image($image,$fileDestination)
    {
        if (isset($image)) {
            $file_name = '/R3P'.time().rand().'.'.$image->extension();
            $image->move($fileDestination,$file_name);
            $file_path =$fileDestination.$file_name;
            return $file_path;  
        }
            
    }
}

