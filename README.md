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
