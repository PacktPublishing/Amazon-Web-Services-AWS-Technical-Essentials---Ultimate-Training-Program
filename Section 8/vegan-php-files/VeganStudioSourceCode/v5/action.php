<?php
include('./db.php');

if($_POST && $_POST['action']=='contest'){
    /* Ensure that the EMPLOYEES table exists. */
    verifyContestTable();
    /* If input fields are populated, add a row to the EMPLOYEES table. */
    $data = array();
    $data['name'] = htmlentities($_POST['name']);
    $data['email'] = htmlentities($_POST['email']); 
    $data['recipe_name'] = htmlentities($_POST['recipe_name']); 
    $data['ingredients'] = htmlentities($_POST['ingredients']);
    $data['method'] = htmlentities($_POST['method']);
    $data['region'] = htmlentities($_POST['region']);
    if($data['name']===''||$data['email']===''||$data['recipe_name']===''||$data['ingredients']===''||$data['method']===''||$data['region']==='' ){
    echo json_encode(array('message'=>'Please fill all fields','status'=>'error')); 
    die();
    }
        addContest($data);
}

if($_GET['action']=='contest'){
   $contest = getContest();
   echo json_encode($contest);
}