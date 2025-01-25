CREATE TABLE page_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_name VARCHAR(255) NOT NULL,
    is_visible BOOLEAN NOT NULL
);

-- กำหนดสถานะเริ่มต้นให้ `page1` เป็น "ไม่แสดง"
INSERT INTO page_status (page_name, is_visible) VALUES ('page1', 0);

CREATE TABLE page_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_name VARCHAR(255) NOT NULL,
    is_visible TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE schedule (
    page_name VARCHAR(50) PRIMARY KEY,
    show_time DATETIME,
    hide_time DATETIME
);
