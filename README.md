# **NXS Spa Web-Based Pointing/Management System**

## **Overview**

The **NXS Spa Web-Based Pointing/Management System** is a web-based management tool designed for spa businesses. It helps manage client points, track services availed, register receptionists, and generate reports. Key features include adding and redeeming points, encrypted QR generation and scanning, and efficient table organization to ensure smooth spa operations.

## **Key Features**

- **Point Management**: 
  - Add and redeem points based on services availed.
  - Efficient tracking of points accumulated by each client.
  
- **Encrypted QR Generation**: 
  - Generate an encrypted QR code once a client is registered to securely track and validate client points.
  - The QR code can be downloaded, sent via email, or the client can take a picture for easy access.

- **QR Scanning**: 
  - Scan QR codes for easy check-ins, point accumulation, and point redemption.

- **Receptionist Registration**: 
  - Allows for the registration of receptionists who are responsible for managing client interactions and point allocations.

- **Table Organization**: 
  - Efficiently manage and organize spa treatment tables for optimal client flow and service delivery.

- **Report Generation**: 
  - Generate detailed reports for services availed, points earned, and points redeemed.

- **Efficient and Reliable**: 
  - Designed for fast and reliable performance to ensure smooth spa operations.

## **Technologies Used**

- **Frontend**: HTML, CSS, JavaScript, jQuery, Bootstrap 5
- **Backend**: PHP
- **Database**: MySQL (XAMPP for local development)
- **QR Code Generation**: PHP libraries for encrypted QR code generation and scanning

## **Setup Instructions**

1. **Clone the repository**:
   ```bash
   git clone https://github.com/kyliecuadra/nxs
   ```
2. **Install XAMPP (if not already installed):**:

  - Download and install XAMPP from XAMPP official website.
  - Start Apache and MySQL services.
3. **Set up the Database:**

  - Create a database named nxs.
  - Import the provided nxs.sql file to set up the tables:
    ```bash
     mysql -u root -p nxs < nxs.sql
    ```
4. **Configure the Web Server:**

  - Place the project files in the htdocs directory of your XAMPP installation (e.g., C:\xampp\htdocs\spa_system).
  - Ensure proper file permissions for read and write access.
5. **Access the System:**

  -Open a web browser and navigate to http://localhost/nxs to start using the system.

## **Usage**
1. **Receptionist Registration:**

  - Admin users can register receptionists who are responsible for managing client points.

2. **Client Check-In:**

  - Once a client is registered, an encrypted QR code is generated.
  - The QR code can be downloaded, sent via email, or the client can take a picture for easy future access.
  
3. **Point Management:**

  - Receptionists can add and redeem points based on client activities and services availed.
  
4. **Reports:**

  - Admins and Receptionist can generate reports to analyze points, services, and other client interactions.

## **Contributing**
If you'd like to contribute to this project, feel free to fork the repository and submit a pull request with your improvements. Please make sure your code follows the existing structure and includes tests where applicable.

## **License**
This project is licensed under the [MIT](https://choosealicense.com/licenses/mit/) License
