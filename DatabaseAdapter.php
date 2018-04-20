<?php

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
    
   
    public function getClasses() {
        $stmt = $this->DB->prepare( "SELECT * FROM courses" );
        $stmt->execute ();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );
        
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

            session_start();
            $_SESSION['permissions'] = $db_user[0]['permissions'];
            $_SESSION['first_name'] = $db_user[0]['first_name'];
            $_SESSION['last_name'] = $db_user[0]['last_name'];
            return 1;
        } else
            return 0;
    }
    
    
}

$theDBA = new DatabaseAdaptor ();
$arr = $theDBA->login('User', 'Pass');

//$arr = $theDBA->register('Jason', 'Hall', 'fondvm', 'User', 'Pass', 1);
print_r($arr);


?>