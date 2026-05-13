-- SQL Script to create the consultations table for Zenith Legal Advocates
-- Database: zenithlegal
-- Created: May 2026

-- Create the consultations table if it doesn't exist
CREATE TABLE IF NOT EXISTS consultations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  subject VARCHAR(200) NOT NULL,
  message LONGTEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status VARCHAR(50) DEFAULT 'pending' COMMENT 'pending, contacted, completed, archived',
  notes LONGTEXT COMMENT 'Internal notes',
  INDEX idx_email (email),
  INDEX idx_created_at (created_at),
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Contact form submissions and consultation requests';

-- If you want to add more tables for team members, practice areas, etc., uncomment below:

-- CREATE TABLE IF NOT EXISTS team_members (
--   id INT AUTO_INCREMENT PRIMARY KEY,
--   name VARCHAR(100) NOT NULL,
--   title VARCHAR(100) NOT NULL,
--   email VARCHAR(100),
--   phone VARCHAR(20),
--   bio LONGTEXT,
--   image_url VARCHAR(255),
--   specialization VARCHAR(100),
--   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- CREATE TABLE IF NOT EXISTS practice_areas (
--   id INT AUTO_INCREMENT PRIMARY KEY,
--   name VARCHAR(100) NOT NULL,
--   description LONGTEXT,
--   icon VARCHAR(255),
--   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
