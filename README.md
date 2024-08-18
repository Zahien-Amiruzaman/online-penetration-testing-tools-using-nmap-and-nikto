# Online Penetration Testing Web Application Using Nmap and Nikto

## Ethical Hacking Reminder

⚠️ **Important Reminder:**

This tool is intended for ethical hacking and security assessments. Please ensure that you have **explicit permission** from the owner of any system you are testing. Unauthorized use of this tool on systems without permission is illegal and unethical.

Always follow these principles:

- **Obtain Written Consent:** Ensure you have documented authorization from the system owner before conducting any penetration tests.
- **Respect Privacy:** Do not access or exploit data unrelated to the scope of your testing.
- **Report Findings Responsibly:** Share vulnerabilities with the system owner in a responsible manner, providing recommendations for remediation.
- **Stay Within Scope:** Only test systems, networks, or applications that you have been explicitly authorized to test.

By using this tool, you agree to abide by all applicable laws and ethical guidelines related to cybersecurity.

## Introduction

This project is an online penetration testing web application designed to assist user in conducting security assessments. It integrates Nmap and Nikto for scanning, offering an alternative to traditional Command Line Interface (CLI) tools with enhanced user experience and built-in scan history management.

## Features

- Nmap and Nikto Integration: Perform network and vulnerability scans directly from the web interface.
- Scan History Management: Review past scan results without needing to rerun scans.

## Project Objectives
- Develop an online penetration testing web application.
- Integrate Nmap and Nikto into the web application.
- Implement scan history management for easy review of past scan results.

## Technology Stack

- Frontend: Bootstrap 5
- Backend: PHP
- Database: MySQL
- Server: Apache (Dockerized)
- Tools: Nmap, Nikto

## Installation

1. Navigate to the project directory:
   
    ```
    cd online-penetration-testing-tools-using-nmap-and-nikto
    ```
2. Set up Docker:

   Ensure Docker is installed and running on your machine. Run the following command to start the Docker containers:

   ```
   docker-compose up -d
   ```
3. Open your web browser and navigate to http://localhost:8080.
4. To open phpMyAdmin Web UI, navigate to http://localhost:8081.

## Configuration

### Web Server

1. Ensure that your project directory contains the docker-compose.yml file, a Dockerfile (if you're building your own image), and the necessary directories (e.g., www for your web content).
2. The service names (webserver, mysql-db, phpmyadmin) and container names (PHP-webServer) are customizable. Change these names if you prefer something more specific to your project.
3. The webserver service builds an image from the current directory (.). If your Dockerfile is located elsewhere or has a different name, update the context and dockerfile fields accordingly.

   ```
   build:
      context: ./path/to/dockerfile
      dockerfile: CustomDockerfileName
   ```

4. The volumes mapping allows you to sync your local directory (./www) with the container’s web root (/var/www/html). If your web files are stored elsewhere, update the path accordingly.

   ```
   volumes:
     - /path/to/your/web/files:/var/www/html
   ```

5. The ports mapping (8000:80) exposes the container’s port 80 to your local machine’s port 8000. Adjust these ports as necessary.

   ```
   ports:
     - 8080:80
   ```

### MySQL Database

1. The mysql-db service uses the mysql:8.0 image. You can change this to a different MySQL version if required.

   ```
   image: mysql:5.7
   ```

2. The environment variables (MYSQL_ROOT_PASSWORD, MYSQL_DATABASE, MYSQL_USER, MYSQL_PASSWORD, TZ) can be updated with your custom database credentials and timezone.

   ```
   environment:
     MYSQL_ROOT_PASSWORD: your_root_password
     MYSQL_DATABASE: your_database_name
     MYSQL_USER: your_database_user
     MYSQL_PASSWORD: your_database_password
     TZ: Your/Timezone
   ```

3. The ports mapping (3306:3306) exposes MySQL’s port 3306 to your local machine. Adjust this if you need to avoid port conflicts.

   ```
   ports:
     - "3306:3306"
   ```

4. The volumes mapping syncs your local directory with the MySQL data directory inside the container. Update this to your preferred location.

   ```
   volumes:
     - /path/to/your/local/mysql/data:/var/lib/mysql
   ```

5. The phpmyadmin service uses the phpmyadmin/phpmyadmin image. The links directive connects it to the MySQL container.
6. The PMA_HOST environment variable should match the name of your MySQL service (mysql-db by default).
7. The MYSQL_ROOT_PASSWORD variable should match the root password used in the mysql-db service.

   ```
   environment:
     PMA_HOST: mysql-db
     MYSQL_ROOT_PASSWORD: your_root_password
   ```

8. The ports mapping (8081:80) exposes phpMyAdmin on your local machine. Adjust the local port as needed.

   ```
   ports:
     - "8081:80"
   ```

9. After customizing the docker-compose.yml file, save your changes.
10. Run the following command to start the services:

      ```
      docker-compose up -d
      ```

11. If you make changes to the docker-compose.yml file later, use:

      ```
      docker-compose down && docker-compose up -d
      ```

## Usage

- Access the application using admin1 for username and password.
- Choose between Nmap or Nikto scans from the dropdown menu.
- Enter the necessary parameters and start the scan.
- View real-time scan progress and access historical results in the Scan History section.

## Scan Types

| Tool  | Scan Type     | Description                            |
|-------|---------------|----------------------------------------|
| Nmap  | Port          | Scan for open ports on a network.      |
| Nmap  | Version       | Detect versions of services running on open ports. |
| Nmap  | Active Host   | Identify active hosts on a network.    |
| Nikto | HTTP          | Scan web servers for vulnerabilities.  |

## Known Issues

- Scanning large targets with Nikto may cause the application to crash.
- Incomplete or missing entries in the scan history under certain conditions.

## Future Improvements

- Add more tools such as Metasploit and password cracking utilities.
- Improve performance for large-scale scans.
