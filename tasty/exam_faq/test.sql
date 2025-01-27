CREATE TABLE page_status (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_name VARCHAR(255) NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL
);
