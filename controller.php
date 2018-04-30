<?php
include 'DatabaseAdapter.php';

if (isset($_POST['login'])) {
    echo $theDBA->login($_POST['user'], $_POST['pass']);
} elseif (isset($_POST['logout'])) {
    session_unset();
} elseif (isset($_POST['register'])) {
    echo $theDBA->register($_POST['first'], $_POST['last'], $_POST['email'], $_POST['user'], $_POST['pass'], $_POST['permissions']);
} elseif (isset($_POST['classCreate'])) {
    echo $theDBA->createClass($_POST['id'], $_POST['title'], $_POST['description'], $_POST['teacherID']);
} elseif (isset($_POST['studentClasses'])) {
    echo json_encode($theDBA->getStudentClasses($_POST['id']));
} elseif (isset($_POST['teacherClasses'])) {
    echo json_encode($theDBA->getTeacherClasses($_POST['id']));
} elseif (isset($_POST['classes'])) {
    echo json_encode($theDBA->getAllClasses());
} elseif (isset($_POST['getAssignmentGrades'])) {
    echo json_encode($theDBA->getAssignmentGrades($_POST['course_id'], $_POST['assignment']));
} elseif (isset($_POST['updateGrade'])) {
    echo $theDBA->updateGrade($_POST['course_id'], $_POST['student_id'], $_POST['value']);
} elseif (isset($_POST['createAssignment'])) {
    echo $theDBA->createAssignment($_POST['course_id'], $_POST['assignment'], $_POST['points']);
} elseif (isset($_POST['getAssignments'])) {
    echo json_encode($theDBA->getAssignments($_POST['course_id']));
<<<<<<< Upstream, based on branch 'dev' of git@github.com:Jasonhall98/337-final.git
} elseif (isset($_POST['studentClassGrades'])) {
    echo json_encode($theDBA->getStudentClassGrades($_POST['id'], $_POST['class']));
=======
} elseif (isset($_POST['studentRegisterClasses'])) {
	echo json_encode($theDBA->registerClass($_POST['course_id'], $_POST['student_id'], $_POST['teacher_id']));
>>>>>>> 562d68e staging classPage stuff
}

?>