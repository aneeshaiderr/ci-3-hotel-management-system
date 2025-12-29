# Web App Project

## Overview
This web application is a fully functional system that provides user authentication, role-based access control, and CRUD operations. The project is built on the CodeIgniter 3 framework, using the Twig templating engine for the front-end and Bootstrap for responsive design. MySQL is used as the database.

---

## Features

### 1. User Authentication
- Secure login and logout system.
- Password hashing for security.
- Session-based authentication.

### 2. Role-Based Access Control
- **Roles**:
  - Super Admin (Full access)
  - Staff (Limited access)
  - User (Normal access)
- Permissions are checked using hooks  functionality.

### 3. CRUD Operations
- Create, Read, Update, Delete operations for various entities.
- Supports database migrations and seeders for easy setup.
- Soft delete functionality  for safe data removal.

### 4. Front-End
- **Twig** templating engine for dynamic and clean views.
- **Bootstrap** for responsive design.
- Global variables and permissions accessible in templates.

### 5. Database
- MySQL database integration.
- Tables
- Seeders available for initial data setup.
- Migration scripts for creating/updating tables.

### 6. Additional Functionality
- Hooks for permission checks and custom logic.
- Role-based menu rendering in frontend.
- Modular code structure for easy maintenance.

---

## Technologies Used
- **Backend:** PHP, CodeIgniter 3
- **Templating Engine:** Twig
- **Frontend:** Bootstrap
- **Database:** MySQL
- **Others:** Migrations, Seeders, Hooks

---

## Created by

- Anees haider
