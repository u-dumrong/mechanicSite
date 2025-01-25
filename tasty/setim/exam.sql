CREATE DATABASE exam_system;

USE exam_system;

-- Create students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL
);

-- Create exam_time table
CREATE TABLE exam_time (
    id INT AUTO_INCREMENT PRIMARY KEY,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL
);

-- Create student_answers table with foreign key
CREATE TABLE student_answers (
    student_id INT NOT NULL,
    answers TEXT,
    exam_taken BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
);
