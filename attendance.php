<?php
require_once "database.php";

class Attendance extends Database {
    public function addAttendance($student_id, $date, $status) {
        $stmt = $this->insert("attendance", "student_id, date, status", ":student_id, :date, :status");
        $stmt->execute([':student_id' => $student_id, ':date' => $date, ':status' => $status]);
    }

    public function getAllAttendance() {
        return $this->read("attendance");
    }

    public function deleteAttendance($id) {
        $this->delete("attendance", $id);
    }

    public function updateAttendance($id, $student_id, $date, $status) {
        $stmt = $this->update("attendance", "student_id = :student_id, date = :date, status = :status", $id);
        $stmt->execute([
            ':student_id' => $student_id,
            ':date' => $date,
            ':status' => $status,
            ':id' => $id
        ]);
    }
}
?>
