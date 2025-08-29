<?php
require_once "database.php";

class Student extends Database {
    public function addStudent($name, $course) {
        $stmt = $this->insert("students", "name, course", ":name, :course");
        $stmt->execute([':name' => $name, ':course' => $course]);
    }

    public function getAllStudents() {
        return $this->read("students");
    }

    public function deleteStudent($id) {
        $this->delete("students", $id);
    }

    public function updateStudent($id, $name, $course) {
        $stmt = $this->update("students", "name = :name, course = :course", $id);
        $stmt->execute([':name' => $name, ':course' => $course, ':id' => $id]);
    }
}
?>
