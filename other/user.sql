--ตารางสำหรับผู้ใช้ทั่วไป:
CREATE TABLE
    users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM ('student', 'teacher') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

--ตารางสำหรับนักศึกษา:
CREATE TABLE
    students (
        user_id INT PRIMARY KEY, -- ใช้เป็น Foreign Key เชื่อมกับ users.id
        score INT DEFAULT 0,
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
    );

--ตารางสำหรับครู:
CREATE TABLE
    teachers (
        user_id INT PRIMARY KEY, -- ใช้เป็น Foreign Key เชื่อมกับ users.id
        department VARCHAR(100),
        FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
    );

INSERT INTO users (username, email, password, role)
VALUES ('teacher_name', 'teacher_email@example.com', 'hashed_password', 'teacher');

INSERT INTO teachers (user_id, department)
VALUES (LAST_INSERT_ID(), 'Mathematics');

-- เพิ่มคอลัมน์ profile_picture สำหรับเก็บรูปโปรไฟล์ในตาราง users
ALTER TABLE users
ADD COLUMN profile_picture VARCHAR(255) DEFAULT NULL;
