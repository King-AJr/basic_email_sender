# Medical Test Management API

This project provides a simple API for managing patient medical tests and records. It includes two main routes: one for fetching available laboratory tests and another for submitting patient test records.

## Overview

This project provides a comprehensive web service designed to manage laboratory tests and medical records. It includes both GraphQL and RESTful APIs, allowing for flexible and powerful interactions with the data. Additionally, when medical records are saved, an email notification is sent to the administrator.

## Folder Structure

Here’s a breakdown of the project's folder structure:

```
project-root/
│
├── app/
│   ├── GraphQL/
│   │   ├── Queries/
│   │   │   ├── LaboratoryTestQuery.php      # Handles queries related to laboratory tests
│   │   │   └── MedicalRecordQuery.php         # Handles queries related to medical records
│   │   └── Mutations/
│   │       └── SaveMedicalRecordMutation.php  # Handles mutations for saving medical records
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   └── AuthController.php         # Manages user authentication (registration and login)
│   │   │   └── LaboratoryTestController.php   # Manages laboratory test data and medical record updates with rest api
│   │   └── Middleware/
│   └── Models/
│       ├── LaboratoryTest.php                  # Model for laboratory tests
│       └── MedicalRecord.php                   # Model for medical records
├── database/
│   ├── migrations/                             # Database migrations for creating tables
│   └── seeds/                                 # Database seeders for initial data
├── resources/
│   ├── views/                                 # Blade templates (if any)
│   └── lang/                                  # Language files (if any)
├── routes/
│   └── api.php                                # API routes definition
├── .env                                      # Environment configuration file
├── composer.json                             # PHP dependencies
├── package.json                              # Node.js dependencies
└── README.md                                 # This file
```

## Authentication

### Authorization Token

To access GraphQL queries or mutations, or to use the REST API routes, you must include a valid authorization token. This token is validated using Laravel Sanctum.

**Example Bearer Token**:
```
Authorization: Bearer 8|JUBHBDCwbGChXDacl12h5UnCZp2M6swEPzzs0AmC9ac5418f
```

### Obtaining a Token

Use the following credentials to obtain a new bearer token via the login endpoint:

- **Email**: `talk2king.aj@gmail.com`
- **Password**: `mypassword`

### GraphQL Authentication

- **Custom Exception Handler**: GraphQL endpoints use a custom exception handler to manage authentication errors. If an unauthenticated request is made, the response will be:

  ```json
  {
    "message": "Please include a valid authorization token"
  }
  ```

### REST API Authentication

- **Custom Exception Handler**: REST API routes use a custom exception handler to return a JSON response with a `401 Unauthorized` status code if the authorization token is missing or invalid:

  ```json
  {
    "message": "Please include a valid authorization token"
  }
  ```

## GraphQL Endpoints

### Queries

- **`laboratoryTests(category: String)`**:
  - **Description**: Fetches laboratory tests, optionally filtered by category.
  - **Parameters**:
    - `category` (optional): The category to filter tests (e.g., "xray").
  - **Example Query**:
    ```graphql
    query {
      laboratoryTests(category: "xray") {
        id
        name
        category
      }
    }
    ```

- **`medicalRecords(patient_name: String)`**:
  - **Description**: Fetches medical records, optionally filtered by patient name.
  - **Parameters**:
    - `patient_name` (optional): The name of the patient to filter records.
  - **Example Query**:
    ```graphql
    query {
      medicalRecords(patient_name: "John Doe") {
        id
        xray
        ultrasound
        ct_scan
        mri
        patient_name
        created_at
      }
    }
    ```

### Mutations

- **`saveMedicalRecord(input: SaveMedicalRecordInput!)`**:
  - **Description**: Saves a medical record and sends an email notification to the admin.
  - **Parameters**:
    - `input`: The input object containing medical record data.
  - **Example Mutation**:
    ```graphql
    mutation {
      saveMedicalRecord(input: {
        xray: ["Chest"],
        ultrasound: ["Obstetric"],
        ct_scan: ["Head"],
        mri: ["Brain"],
        patient_name: "John Doe"
      }) {
        id
        patient_name
        xray
        ultrasound
        ct_scan
        mri
        created_at
      }
    }
    ```
  - **Note**: An email notification will be sent to `talk2ata@gmail.com` when a medical record is saved.

## REST API Endpoints

### Public Routes

- **`POST /register`**:
  - **Description**: Registers a new user and returns an authentication token.
  - **Request Body**:
    ```json
    {
      "name": "John Doe",
      "email": "john.doe@example.com",
      "password": "password123"
    }
    ```
  - **Response**:
    ```json
    {
      "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john.doe@example.com"
      },
      "access_token": "your-new-token",
      "token_type": "Bearer"
    }
    ```

- **`POST /login`**:
  - **Description**: Authenticates a user and returns an authentication token.
  - **Request Body**:
    ```json
    {
      "email": "talk2king.aj@gmail.com",
      "password": "mypassword"
    }
    ```
  - **Response**:
    ```json
    {
      "message": "Login successful",
      "access_token": "your-new-token",
      "token_type": "Bearer"
    }
    ```

### Protected Routes

- **`GET /laboratory-tests`**:
  - **Description**: Retrieves available laboratory tests grouped by category.
  - **Headers**:
    ```http
    Authorization: Bearer <your-token>
    ```
  - **Response**:
    ```json
    {
      "xray": ["Chest", "Cervical Vertebrae"],
      "ultrasound_scan": ["Obstetric", "Abdominal"],
      "ct_scan": ["Head", "Chest"],
      "mri": ["Brain", "Spine"]
    }
    ```

- **`POST /patient-record-update`**:
  - **Description**: Submits a medical record and sends an email notification to the admin.
  - **Headers**:
    ```http
    Authorization: Bearer <your-token>
    ```
  - **Request Body**:
    ```json
    {
      "patient_name": "John Doe",
      "xray": ["Chest"],
      "ultrasound_scan": ["Obstetric"],
      "ct_scan": ["Head"],
      "mri": ["Brain"]
    }
    ```
  - **Response**:
    ```json
    {
      "message": "Medical data submitted successfully"
    }
    ```

## Setup and Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/King-AJr/sevenz-healthcare-be-test.git
   ```

2. **Install Dependencies**:
   Navigate to the project directory and install PHP and Node.js dependencies:
   ```bash
   cd your-project-directory
   composer install
   npm install
   ```

3. **Configure Environment**:
   - Copy `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update the `.env` file with your environment settings, including database credentials and mail configurations.

4. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**:
   Apply the database migrations to create the necessary tables:
   ```bash
   php artisan migrate
   ```

6. **Serve the Application**:
   Start the local development server:
   ```bash
   php artisan serve
   ```

## Contributing

Contributions to this project are welcome. Please adhere to the following guidelines:
- Open an issue to discuss proposed changes or improvements.
- Submit a pull request with a clear description of your changes.
- Ensure that your code follows the project's coding standards and passes all tests.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.
