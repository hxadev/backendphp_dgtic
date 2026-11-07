-- ════════════════════════════════════════════════════════════
-- LEARNHUB — DDL
-- Plataforma de Cursos Online
-- Instructor: Alfonso Hernández Xochipa | hxadev.tech
-- ════════════════════════════════════════════════════════════

CREATE DATABASE IF NOT EXISTS learnhub
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE learnhub;

-- ════════════════════════════════════════════════════════════
-- LEVELS
-- ════════════════════════════════════════════════════════════
CREATE TABLE levels (
    id INT PRIMARY KEY,
    title VARCHAR(100),
    description TEXT,
    active BOOLEAN DEFAULT TRUE
);

-- ════════════════════════════════════════════════════════════
-- CATEGORIES
-- ════════════════════════════════════════════════════════════
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(200) NOT NULL UNIQUE,
    description TEXT,
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ════════════════════════════════════════════════════════════
-- INSTRUCTORS
-- ════════════════════════════════════════════════════════════
CREATE TABLE instructors (
    id VARCHAR(10) PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    bio TEXT,
    speciality VARCHAR(30),
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ════════════════════════════════════════════════════════════
-- COURSES
-- ════════════════════════════════════════════════════════════
CREATE TABLE courses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    duration INT DEFAULT 0,
    active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    ranking INT DEFAULT 0,
    level_id INT,
    category_id INT,

    CONSTRAINT fk_courses_level
        FOREIGN KEY (level_id) REFERENCES levels(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CONSTRAINT fk_courses_category
        FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CHECK (price >= 0),
    CHECK (duration >= 0),
    CHECK (ranking >= 0 AND ranking <= 5)
);

-- ════════════════════════════════════════════════════════════
-- INSTRUCTORS_COURSES (Tabla intermedia N:M)
-- ════════════════════════════════════════════════════════════
CREATE TABLE instructors_courses (
    id_course INT NOT NULL,
    id_instructor VARCHAR(10) NOT NULL,

    PRIMARY KEY (id_course, id_instructor),

    CONSTRAINT fk_ic_course
        FOREIGN KEY (id_course) REFERENCES courses(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CONSTRAINT fk_ic_instructor
        FOREIGN KEY (id_instructor) REFERENCES instructors(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- ════════════════════════════════════════════════════════════
-- MODULES
-- ════════════════════════════════════════════════════════════
CREATE TABLE modules (
    id VARCHAR(15) PRIMARY KEY,
    title VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    position INT DEFAULT 1,
    duration INT DEFAULT 0,
    active BOOLEAN DEFAULT TRUE,
    id_course INT NOT NULL,

    CONSTRAINT fk_modules_course
        FOREIGN KEY (id_course) REFERENCES courses(id)
        ON DELETE CASCADE ON UPDATE CASCADE,

    CHECK (position > 0),
    CHECK (duration >= 0)
);

-- ════════════════════════════════════════════════════════════
-- STUDENTS
-- ════════════════════════════════════════════════════════════
CREATE TABLE students (
    id VARCHAR(15) PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(50) NOT NULL,
    birth_date DATE,
    country CHAR(3),
    city VARCHAR(30),
    state VARCHAR(40),
    active BOOLEAN DEFAULT TRUE
);

-- ════════════════════════════════════════════════════════════
-- ENROLLMENTS
-- ════════════════════════════════════════════════════════════
CREATE TABLE enrollments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_student VARCHAR(15) NOT NULL,
    id_course INT NOT NULL,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    grade DECIMAL(4,2),
    status ENUM('ENROLLED', 'IN_PROGRESS', 'COMPLETED', 'DROPPED') DEFAULT 'ENROLLED',
    completion_date TIMESTAMP NULL,

    CONSTRAINT fk_enrollments_student
        FOREIGN KEY (id_student) REFERENCES students(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CONSTRAINT fk_enrollments_course
        FOREIGN KEY (id_course) REFERENCES courses(id)
        ON DELETE RESTRICT ON UPDATE CASCADE,

    CONSTRAINT uq_student_course UNIQUE (id_student, id_course),

    CHECK (grade >= 0 AND grade <= 10)
);

-- ════════════════════════════════════════════════════════════
-- ÍNDICES
-- ════════════════════════════════════════════════════════════
CREATE INDEX idx_courses_level ON courses(level_id);
CREATE INDEX idx_courses_category ON courses(category_id);
CREATE INDEX idx_modules_course ON modules(id_course);
CREATE INDEX idx_enrollments_student ON enrollments(id_student);
CREATE INDEX idx_enrollments_course ON enrollments(id_course);
CREATE INDEX idx_enrollments_status ON enrollments(status);