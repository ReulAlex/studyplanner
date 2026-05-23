CREATE DATABASE IF NOT EXISTS studyplanner_db
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE studyplanner_db;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(191) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uniq_users_email (email)
);

CREATE TABLE IF NOT EXISTS tasks (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    deadline DATE NULL,
    status ENUM('de_facut', 'in_progres', 'finalizat') NOT NULL DEFAULT 'de_facut',
    priority ENUM('mica', 'medie', 'mare') NOT NULL DEFAULT 'medie',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_tasks_user_id (user_id),
    KEY idx_tasks_deadline (deadline),
    CONSTRAINT fk_tasks_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);
