<?php 

class Course {
    private $db;
    private $name;
    private $code;
    private $progression;
    private $syllabus;
    

    //Constructor 
    public function __construct() {

        // Database connection
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);

        //Check connection
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connection_error);
        }
    }



    //Add course
    public function addCourse($name, $code, $progression, $syllabus) {
        //Control if correct values
        if(!$this->setName($name)){
            return false;
        }
        if(!$this->setCode($code)){
            return false;
        }
        if(!$this->setProgression($progression)){
            return false;
        }
        if(!$this->setSyllabus($syllabus)){
            return false;
        }


        $sql = "INSERT INTO courses(name, code, progression, syllabus) VALUES ('$this->name', '$this->code', '$this->progression', '$this->syllabus')";
            
        return $result = $this->db->query($sql);
    }


    
    //Update courses
    public function updateCourse ($id, $name, $code, $progression, $syllabus) {
        //Control if correct values
        $id = intval($id);
        if(!$this->setName($name)){
            return false;
        }
        if(!$this->setCode($code)){
            return false;
        }
        if(!$this->setProgression($progression)){
            return false;
        }
        if(!$this->setSyllabus($syllabus)){
            return false;
        }


        $sql = "UPDATE courses SET name='" . $this->name . "', code=' " . $this->code . "', progression=' " . $this->progression . "', syllabus='" . $this->syllabus . "' WHERE id=$id";
        
        return $result = $this->db->query($sql);
    }


    //Delete course by code
    public function deleteCourse ($id) {
        $id = intval($id);

        $sql = "DELETE FROM courses WHERE id=$id";

        return $this->db->query($sql);
    }


    //Getters ------------------------------------------------------------------------------------------------------

    //Get all courses
    public function getCourses () {
        $sql = "SELECT * FROM courses ORDER BY name";
        $result = $this->db->query($sql);
            
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    //Setters ------------------------------------------------------------------------------------------------------

    //Set name
    public function setName ($name) {
        if($name != "") {
            $this->name = $this->db->real_escape_string($name);

            return true;
        }else {
            return false;
        }
    }


    //Set code
    public function setCode ($code) {
        if($code != "") {
            $this->code = $this->db->real_escape_string($code);

            return true;
        }else {
            return false;
        }
    }


    //Set progression
    public function setProgression ($progression) {
        if($progression != "") {
            $this->progression = $this->db->real_escape_string($progression);

            return true;
        }else {
            return false;
        }
    }


    //Set syllabus
    public function setSyllabus ($syllabus) {
        if($syllabus != "") {
            $this->syllabus = $this->db->real_escape_string($syllabus);

            return true;
        }else {
            return false;
        }
    }
}
?>