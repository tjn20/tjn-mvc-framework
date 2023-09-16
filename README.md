# TJN-MVC-FRAMEWORK
The framework has not undergone extensive testing in a production environment. If you choose to use it in a production setting, please be aware that you do so at your own discretion and assume any associated risks.

An open-source web development solution, this PHP MVC framework harnesses object-oriented PHP and the reliability of MySQL. Committed to simplicity, flexibility, and scalability, the framework provides a robust Model-View-Controller (MVC) architecture, ensuring clean and organized code. It simplifies database schema management with built-in migration tools, handles complex routing rules, and enables developers to create dynamic views using a versatile templating engine. Secure authentication and role-based access control are seamlessly implemented, and dependencies are efficiently managed with the integrated container. Middleware is available for authorization checks, enhancing security. As an open-source project, contributions from a global community of developers continually enhance its capabilities. Embrace the efficiency and security of MySQL for data storage needs, and embark on a journey of modern web development with this PHP MVC framework. Create web applications that are not only powerful but also adaptable and ready to scale.

# FEATURES
### 1. Model-View-Controller (MVC) Architecture
   - Follows the MVC design pattern to separate concerns, ensuring clean code, maintainability, and scalability.

### 2. Middleware
   - Middleware support for adding extra layers of security.
   - Easily extend and customize middleware to add functionality like authentication, logging, and more.

### 3. Routing
   - Powerful routing system for mapping URLs to controllers and actions.
   - Define custom routes with parameters and constraints.

### 4. Database Migrations
   - Built-in database migration system for managing database schema changes.
   - Seamlessly create, modify, and roll back database migrations.

### 5. Templating Engine
   - Flexible templating engine for creating dynamic views.
   - Supports template inheritance and reusable components.

### 6. Authentication and Authorization
   - Easily implement user authentication and role-based access control (RBAC).
   - Protect routes and actions with fine-grained permissions.

### 7. Request and Response Handling
   - Effortlessly handle HTTP requests and generate responses.
     
### 8. Open Source
   - Developed as an open-source project, allowing the community to contribute, improve, and customize the framework.
   - Benefit from the open-source community's continuous updates, bug fixes, and feature enhancements.

# How to install
1. Clone the project using git.
2. create your database schema.
3. Make a copy of the .env.example file and rename it as .env. Inside the .env file, update the database settings, including the schema name, to match your specific configuration.
4. Execute the migration process by running php migration.php from the command line or by accessing the file path in the URL to configure your database settings.
