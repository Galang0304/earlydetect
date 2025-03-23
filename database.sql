CREATE DATABASE IF NOT EXISTS early_detect;
USE early_detect;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin account
INSERT INTO admin (username, password) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'); -- password: password

CREATE TABLE IF NOT EXISTS questions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    question_text TEXT NOT NULL,
    correct_answer ENUM('Ya', 'Tidak') NOT NULL,
    follow_up_questions TEXT,
    requires_follow_up BOOLEAN DEFAULT FALSE
);

-- Hapus tabel jika sudah ada
DROP TABLE IF EXISTS quiz_results;

-- Buat ulang tabel quiz_results dengan struktur yang benar
CREATE TABLE quiz_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_score INT NOT NULL,
    risk_level ENUM('RENDAH', 'MEDIUM', 'TINGGI') NOT NULL,
    failed_questions TEXT,
    needs_follow_up BOOLEAN DEFAULT FALSE,
    follow_up_completed BOOLEAN DEFAULT FALSE,
    follow_up_score INT,
    follow_up_date TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Hapus data yang mungkin sudah ada
TRUNCATE TABLE questions;

-- Insert pertanyaan M-CHAT-R/F dengan logika yang benar
INSERT INTO questions (question_text, correct_answer, requires_follow_up) VALUES
('Jika Anda menunjuk sesuatu di ruangan, apakah anak Anda melihatnya? (Misalnya, jika anda menunjuk hewan atau mainan, apakah anak anda melihat ke arah hewan atau mainan yang anda tunjuk?)', 'Ya', TRUE),
('Pernahkah anda berpikir bahwa anak anda tuli?', 'Tidak', FALSE),
('Apakah anak anda pernah bermain pura-pura? (Misalnya, berpura-pura minum dari gelas kosong, berpura-pura berbicara menggunakan telepon, atau menyuapi boneka atau boneka binatang?)', 'Ya', TRUE),
('Apakah anak anda suka memanjat benda-benda? (Misalnya, furniture, alat-alat bermain, atau tangga)', 'Ya', FALSE),
('Apakah anak anda menggerakkan jari-jari tangannya dengan cara yang tidak biasa di dekat matanya? (Misalnya, apakah anak anda menggoyang-goyangkan jari dekat pada matanya?)', 'Tidak', TRUE),
('Apakah anak anda pernah menunjuk dengan satu jari untuk meminta sesuatu atau untuk meminta tolong? (Misalnya, menunjuk makanan atau mainan yang jauh dari jangkauannya)', 'Ya', TRUE),
('Apakah anak anda pernah menunjuk dengan satu jari untuk menunjukkan sesuatu yang menarik pada anda? (Misalnya, menunjuk pada pesawat di langit atau truk besar di jalan)', 'Ya', TRUE),
('Apakah anak anda tertarik pada anak lain? (Misalnya, apakah anak anda memperhatikan anak lain, tersenyum pada mereka atau pergi ke arah mereka)', 'Ya', TRUE),
('Apakah anak anda pernah memperlihatkan suatu benda dengan membawa atau mengangkatnya kepada anda – tidak untuk minta tolong, hanya untuk berbagi? (Misalnya, memperlihatkan anda bunga, binatang atau truk mainan)', 'Ya', TRUE),
('Apakah anak anda memberikan respon jika namanya dipanggil? (Misalnya, apakah anak anda melihat, bicara atau bergumam, atau menghentikan apa yang sedang dilakukannya saat anda memanggil namanya)', 'Ya', TRUE),
('Saat anda tersenyum pada anak anda, apakah anak anda tersenyum balik?', 'Ya', TRUE),
('Apakah anak anda pernah marah saat mendengar suara bising sehari-hari? (Misalnya, apakah anak anda berteriak atau menangis saat mendengar suara bising seperti vacuum cleaner atau musik keras?)', 'Tidak', TRUE),
('Apakah anak anda bisa berjalan?', 'Ya', FALSE),
('Apakah anak anda menatap mata anda saat anda bicara padanya, bermain bersamanya, atau saat memakaikannya pakaian?', 'Ya', TRUE),
('Apakah anak anda mencoba meniru apa yang anda lakukan? (Misalnya, melambai-lambai tangan, tepuk tangan atau meniru saat anda membuat suara lucu)', 'Ya', TRUE),
('Jika anda memutar kepala untuk melihat sesuatu, apakah anak anda melihat sekeliling untuk melihat apa yang anda lihat?', 'Ya', TRUE),
('Apakah anak anda mencoba untuk membuat anda melihat kepadanya? (Misalnya, apakah anak anda melihat anda untuk dipuji atau berkata "lihat" atau "lihat aku")', 'Ya', TRUE),
('Apakah anak anda mengerti saat anda memintanya melakukan sesuatu? (Misalnya, jika anda tidak menunjuk, apakah anak anda mengerti "letakkan buku itu di atas kursi" atau "ambilkan saya selimut")', 'Ya', TRUE),
('Jika sesuatu yang baru terjadi, apakah anak anda menatap wajah anda untuk melihat perasaan anda tentang hal tersebut? (Misalnya, jika anak anda mendengar bunyi aneh atau lucu, atau melihat mainan baru, akankah dia menatap wajah anda?)', 'Ya', TRUE),
('Apakah anak anda menyukai aktivitas yang bergerak? (Misalnya, diayun-ayun atau dihentakkan pada lutut anda)', 'Ya', FALSE); 