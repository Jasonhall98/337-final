<?php
session_start();

class DatabaseAdaptor {
    // The instance variable used in every one of the functions in class DatbaseAdaptor
    private $DB;
    // Make a connection to the data based named 'imdb_small' (described in project).
    public function __construct() {
        $db = 'mysql:dbname=final;host=127.0.0.1;charset=utf8';
        $user = 'root';
        $password = '';
        
        try {
            $this->DB = new PDO ( $db, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    }

    
    public function register($first, $last, $email, $user, $pass, $permissions) {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        
        $stmt = $this->DB->prepare("SELECT * from users where username = :user");
        $stmt->bindParam(':user', $user);
        $stmt->execute ();
        $db_user = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        if ($db_user == null ){
        
            $stmt = $this->DB->prepare( "INSERT INTO users (first_name, last_name, email, username, hash, permissions) values 
                                        (:first, :last, :email, :user, :hash, :permissions)"  );
            $stmt->bindParam(':first', $first);
            $stmt->bindParam(':last', $last);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':user', $user);
            $stmt->bindParam(':hash', $hash);
            $stmt->bindParam(':permissions', $permissions);
            
            
            $stmt->execute ();
            
            $theDBA->login($user, $pass);
            
            return 1;
        }
        return 0;
    }
   
    
    public function login($user, $pass) {
        $stmt = $this->DB->prepare("SELECT * from users where username = :user");
        $stmt->bindParam(':user', $user);
        $stmt->execute ();
        $db_user = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        if (password_verify($pass, $db_user[0]['hash'])) {

            $_SESSION['permissions'] = $db_user[0]['permissions'];
            $_SESSION['first_name'] = $db_user[0]['first_name'];
            $_SESSION['last_name'] = $db_user[0]['last_name'];
            $_SESSION['id'] = $db_user[0]['id'];
            return 1;
        } else
            return 0;
    }
    
    public function createClass($id, $title, $description, $teacherID) {
        $stmt = $this->DB->prepare("SELECT * from courses where course_id = :id OR title = :title");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->execute ();
        $db_user = $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
        if ($db_user == null ){
            $stmt = $this->DB->prepare( "INSERT INTO courses (course_id, title, description, teacher_id) values
                                        (:id, :title, :description, :teacherID)"  );
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':teacherID', $teacherID);
        
            $stmt->execute ();
            
            return 1;
        }
        return 0;
        
    }
    
    public function getTeachers() {
        $stmt = $this->DB->prepare("SELECT first_name, last_name, id from users where permissions = 2");
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC );
        
    }
    
    public function getTeacherClasses($id) {
        $stmt = $this->DB->prepare("SELECT * from courses where teacher_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC );
    }
    
    
    public function getStudentClasses($id) {
        $stmt = $this->DB->prepare( "SELECT * FROM grades join courses on grades.course_id = courses.course_id where student_id = :id" );
        $stmt->bindParam(':id', $id);
        $stmt->execute ();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
    }
    
    public function getAllClasses() {
        $stmt = $this->DB->prepare("SELECT * from courses");
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC );
        
    }
    
    public function getGradesTeacher($course_id) {
        $stmt = $this->DB->prepare("SELECT * from grades join users on grades.student_id = users.id where course_id = :course_id");
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC );
        
    }
    
    public function updateGrade($course_id, $student_id, $value) {
        $stmt = $this->DB->prepare("UPDATE grades SET grade = :value where course_id = :course_id and student_id = :student_id");
        $stmt->bindParam(":value", $value);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->execute();
    
    }
    
}

$theDBA = new DatabaseAdaptor ();
//$arr = $theDBA->login('User', 'Pass');
//$arr = $theDBA->register('Jason', 'Hall', 'fondvm', 'User', 'Pass', 1);
//$arr = $theDBA->updateGrades(666, 7,"A");
//print_r($arr);


?>