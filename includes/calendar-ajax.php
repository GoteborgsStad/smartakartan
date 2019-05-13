<?php

add_action('wp_ajax_calendar_date', 'calendar_date');
add_action('wp_ajax_nopriv_calendar_date', 'calendar_date');

function calendar_date() {
       
  // if data
  
    if (isset($_POST['month'])) {

    // 2. get days for the chosen month with ajax
    $month = $_POST['month'];
    
    
    //echo "hej";
    $postHandler = new postHandler(); 
    $events = $postHandler->getEvents();
    
   print_r($events);
    
    foreach ($events[$month] as $key => $value) {
  
         echo '<option value="'.$value.'">'.$value.'</option>';
    }
   
    
    die();
        
    } // if
    
    
    wp_send_json_error('Error');
}
