<?php
include_once("includes/config.php");

/*Settings for the REST API*/

//What domains has access to the REST API
header('Access-Control-Allow-Origin: *');

//What type of content the REST API is sending. JSON-format
header('Content-Type: application/json');

//What methods that are accepted
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE');

//What headers are allowed from the client side
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

//Stores what request method is being used in a variable
$method = $_SERVER['REQUEST_METHOD'];

//Get parameter ID from the URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
}

//New instance of the course class
$course = new Course();

switch($method) {
    case 'GET':
        //"HTTP response status code"
        http_response_code(200); //Valid request

        //Get all courses
        $response = $course->getCourses();

        if(count($response) == 0) {
            //Response message
            $response = array("message" => "Empty");
        }
    break;




    case 'POST':
        //Reads the J-SON and turns it into an object.
        $data = json_decode(file_get_contents("php://input"));


        //Checks if empty values
        if($data->name == "" || $data->code == "" || $data->progression == "" || $data->syllabus == "") {
            $response = array("message" => "Enter all fields!");

            http_response_code(400); //User error
        } else {
            //Adds course
            if($course->addCourse($data->name, $data->code, $data->progression, $data->syllabus)) {
                $response = array("message" => "Course added!");
    
                http_response_code(201); //Valid request
            } else {
                //Failed to add course message and code
                $response = array("message" => "Failed to add course!");
    
                http_response_code(500); //Server error
            }
        }
    break;



    case 'PUT':
        //Checks for ID
        if(!isset($id)) {
            http_response_code(400); //User error
            $response = array("message" => "No id sent");
         
        } else {
            $data = json_decode(file_get_contents("php://input"));

            //Update course
            if($course->updateCourse($id, $data->name, $data->code, $data->progression, $data->syllabus)) {
                http_response_code(200); //Valid request
                $response = array("message" => "Course with id=$id is updated");
            } else {
                //Update failed message and code
                $response = array("message" => "Failed to update course!");
    
                http_response_code(500); //Server error
            }
        }
    break;


    case 'DELETE':
        //Checks for ID
        if(!isset($id)) {
            //No ID error message & code
            http_response_code(400); //User error
            $response = array("message" => "No id sent");  
        } else {
            //Delete course
            if($course->deleteCourse($id)) {
                http_response_code(200); //Valid request
                $response = array("message" => "Course with id=$id is deleted");
            } else {
                //Delete failed message and code
                $response = array("message" => "Failed to delete course!");
    
                http_response_code(500); //Server error
            }
        }
    break;
   
}

//Send response to user
echo json_encode($response);