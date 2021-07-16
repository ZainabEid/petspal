<?php


use Illuminate\Support\Facades\Storage;




###### GET MODELS HELPERS #####

if (!function_exists('get_models')) {
function getModels(){

    $path = app_path() . "/Models";

    $other_models =[
        'role','permissions'
    ];
    
    $out = [];
    $results = scandir($path);

    foreach ($results as $result) {

        if ($result === '.' or $result === '..') continue;

        $filename = $path . '/' . $result;

        if (is_dir($filename)) {

            $out = array_merge($out, getModels($filename));

        }else{

            $out[] = basename(substr($filename,0,-4));
        }
    }

    return array_merge( array_map('strtolower', $out), $other_models ) ;

    } //end of get_models helper
} // end of check exist



// get all crud_maps helper funcion
if (!function_exists('crud_maps')) {
    function crud_maps()
    {
       $crud_maps =  ['create', 'read' , 'update', 'delete'];  ;

        return $crud_maps;
    } //end of crud_maps helper
} // end of check exist






####### IMAGE HELPERS #######


// save imagae helper
if (!function_exists('save_image')) {
    function save_image($folder, $image)
    {
        $image_name = $image->store('uploads/' . $folder . '/' ,'public');

        return $image_name;
    } //end of save_image helper
    
} // end of check exist


// get image helper
if (!function_exists('get_image')) {
    function get_image($folder, $image_name)
    {
       // $image_path = asset('storage/uploads/'.$folder.'/'.$image_name);

        $image_path =  url('storage/uploads/'.$folder.'/'.$image_name) ;

      // $image_path = Storage::disk('local')->get('uploads/'. $folder.'/'. $image_name);

        return $image_path;
    } //end of get_image helper
} // end of check exist

// get image helper
if (!function_exists('delete_image')) {
    function delete_image($folder, $image_name)
    {

        if( $image_name != 'default.png'){
            if ( Storage::disk('public')->exists('uploads/'.$folder.'/'.$image_name)) {
                Storage::disk('public')->delete('uploads/'.$folder.'/'.$image_name);
                
            }
        }
      
    } //end of get_image helper
} // end of check exist



##### DAYS HELPERS #####

// Get_days helper
if (!function_exists('get_days')) {
    function get_days()
    {
        // needed to be translated
        $dayNames = array(
            'Sunday',
            'Monday', 
            'Tuesday', 
            'Wednesday', 
            'Thursday', 
            'Friday', 
            'Saturday', 
         );

         return $dayNames;
    } //end of get_days helper
    
} // end of check exist
