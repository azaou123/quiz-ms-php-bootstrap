-- Database: quiz_management_system

-- Table: users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('superadmin', 'teacher', 'student') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: quizzes
CREATE TABLE quizzes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    user_id INT NOT NULL,
    status_id INT NOT NULL,
    isPublic BOOLEAN NOT NULL,
    isSysCan BOOLEAN NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: questions
CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    question_text TEXT,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id)
);

-- Table: answers
CREATE TABLE answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT NOT NULL,
    answer_text TEXT NOT NULL,
    status ENUM('true', 'false') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (question_id) REFERENCES questions(id)
);

-- Table: quiz_attempts
CREATE TABLE quiz_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quiz_id INT NOT NULL,
    user_id INT NOT NULL,
    score INT DEFAULT 0,
    completed_at TIMESTAMP NULL DEFAULT NULL,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Table: quiz_responses
CREATE TABLE quiz_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    attempt_id INT NOT NULL,
    question_id INT NOT NULL,
    answer_id INT NOT NULL,
    FOREIGN KEY (attempt_id) REFERENCES quiz_attempts(id),
    FOREIGN KEY (question_id) REFERENCES questions(id),
    FOREIGN KEY (answer_id) REFERENCES answers(id)
);
