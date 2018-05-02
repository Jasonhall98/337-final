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
        $stmt = $this->DB->prepare( "SELECT * FROM curClasses join courses on curClasses.class_id = courses.course_id where student_id = :id" );
        $stmt->bindParam(':id', $id);
        $stmt->execute ();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
    }
    
    public function getStudentTranscript($id) {
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
    
    public function getAssignmentGrades($course_id, $assignment) {
        $stmt = $this->DB->prepare("SELECT * from curGrades join users on curGrades.student_id = users.id where class_id = :course_id and assignment = :assignment");
        $stmt->bindParam(':course_id', $course_id);
        $stmt->bindParam(':assignment', $assignment);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC );
        
    }
    
    public function updateGrade($course_id, $student_id, $value, $assignment) {
        $stmt = $this->DB->prepare("UPDATE curGrades SET points = :value where class_id = :course_id and student_id = :student_id and assignment = :assignment");
        $stmt->bindParam(":value", $value);
        $stmt->bindParam(":course_id", $course_id);
        $stmt->bindParam(":student_id", $student_id);
        $stmt->bindParam(":assignment", $assignment);
        $stmt->execute();
    
    }
    
    public function createAssignment($course_id, $assignment, $points) {
        
        $stmt = $this->DB->prepare("insert into assignments (class_id, assignment) values (:course_id, :assignment)");
        $stmt->bindParam(':course_id', $course_id);
        $stmt->bindParam(':assignment', $assignment);
        $stmt->execute();
        
        $stmt = $this->DB->prepare("select * from curClasses where class_id = :class_id");
        $stmt->bindParam(":class_id", $course_id);
        $stmt->execute();
        $arr = $stmt->fetchAll (PDO::FETCH_ASSOC);
        
        for ($i = 0; $i < count($arr); $i++) {
            $stmt = $this->DB->prepare("insert into curGrades (class_id, student_id, assignment, maxPoints) values (:course_id, :student_id, :assignment, :points)");
            $stmt->bindParam(":course_id", $course_id);
            $stmt->bindParam(":student_id", $arr[$i]['student_id']);
            $stmt->bindParam("assignment", $assignment);
            $stmt->bindParam("points", $points);
            $stmt->execute();
        }
        
    }
    
    public function getAssignments ($course_id) {
        $stmt = $this->DB->prepare("SELECT * from assignments where class_id = :course_id");
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC );
        
    }
  
    public function getStudentClassGrades($id, $class) {
        $stmt = $this->DB->prepare("SELECT * from curGrades where class_id = :class and student_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':class', $class);
        $stmt->execute();
        return $stmt->fetchAll (PDO::FETCH_ASSOC );
        
    }
    
    public function registerClass($course_id, $student_id, $teacher_id) {
    	$stmt = $this->DB->prepare("INSERT INTO currClasses(teacher_id, class_id, student_id) values (:teacher, :class, :student)");
    	$stmt->bindParam(':teacher', $teacher_id);
    	$stmt->bindParam(':student', $student_id);
    	$stmt->bindParam(':class', $course_id);
    	$stmt->execute();
    }
    
    public function finalizeGrades($course_id) {
        $stmt = $this->DB->prepare("SELECT * from curGrades where class_id = :course_id order by student_id");
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();
        $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $i = 0;        
        while ($i < count($arr)) {
            $curStudent = $arr[$i]['student_id'];
            
            $points = 0;
            $maxPoints = 0;
            
            while ($i < count($arr) && $arr[$i]['student_id'] == $curStudent) {
                $points += $arr[$i]['points'];
                $maxPoints += $arr[$i]['maxPoints'];
                
                
                $i++;
            }
            
            $percentage = $points / (float) $maxPoints;
            
            $grade;
            if ($percentage >= .9) {
                $grade = 'A';
            } elseif ($percentage >= .8) {
                $grade = 'B';
            } elseif ($percentage >= .7) {
                $grade = 'C';
            } elseif ($percentage >= .6) {
                $grade = 'D';
            } else {
                $grade = 'F';
            }
            
            
            $stmt = $this->DB->prepare("INSERT INTO grades (course_id, grade, student_id) values (:course_id, :grade, :student)");
            $stmt->bindParam(':course_id', $course_id);
            $stmt->bindParam(':student', $curStudent);
            $stmt->bindParam(':grade', $grade);
            $stmt->execute();
            
        }
        
        $stmt = $this->DB->prepare("DELETE from assignments where class_id = :class_id");
        $stmt->bindParam(':class_id', $course_id);
        $stmt->execute();
        
        $stmt = $this->DB->prepare("DELETE from curClasses where class_id = :class_id");
        $stmt->bindParam(':class_id', $course_id);
        $stmt->execute();
        
        $stmt = $this->DB->prepare("DELETE from curGrades where class_id = :class_id");
        $stmt->bindParam(':class_id', $course_id);
        $stmt->execute();
        
        $stmt = $this->DB->prepare("DELETE from courses where course_id = :class_id");
        $stmt->bindParam(':class_id', $course_id);
        $stmt->execute();
    }
}

$theDBA = new DatabaseAdaptor ();
//$arr = $theDBA->login('User', 'Pass');
//$arr = $theDBA->register('Jason', 'Hall', 'fondvm', 'User', 'Pass', 1);
//$arr = $theDBA->getAssignmentGrades(666, 'Assignment1');
//$arr = $theDBA->createAssignment(666, 'Assignment1', 10);
//$arr = $theDBA->finalizeGrades(666);
//print_r($arr);


?>