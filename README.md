# Medical Test Management API

This project provides a simple API for managing patient medical tests and records. It includes two main routes: one for fetching available laboratory tests and another for submitting patient test records.

## Features

- **Retrieve Available Laboratory Tests**: Fetch a list of available medical tests such as X-Rays, Ultrasound Scans, CT Scans, and MRIs.
- **Submit Patient Test Records**: Validate and store patient test records, and send an email notification with the details.

## Routes

### 1. Retrieve Available Laboratory Tests

**Endpoint**: `GET /laboratory-tests`

**Description**: Returns a list of available medical tests with specific options for each test type.

**Sample Response**:
```json
{
    "x_ray": [
        "Chest",
        "Cervical Vertebrae",
        "Thoracic Vertebrae",
        "Lumbar Vertebrae",
        "Lumbo Sacral Vertebrae",
        ...
    ],
    "ultrasound_scan": [
        "Obstetric",
        "Abdominal",
        "Pelvis",
        "Prostate",
        "Breast",
        "Thyroid"
    ],
    "ct_scan": [
        "Head",
        "Chest",
        "Abdomen",
        "Pelvis",
        "Spine"
    ],
    "mri": [
        "Brain",
        "Spine",
        "Knee",
        "Shoulder",
        "Abdomen"
    ]
}
```

### 2. Submit Patient Test Records

**Endpoint**: `POST /patient-record-update`

**Description**: Accepts patient medical test records, validates the data, and sends an email notification.

**Request Data**:
- `patient_name`: (required) The name of the patient.
- `x_ray`: (optional) An array of X-Ray tests performed.
- `ultrasound_scan`: (optional) An array of Ultrasound scans performed.
- `ct_scan`: (optional) An array of CT scans performed.
- `mri`: (optional) An array of MRI scans performed.

**Sample Request**:
```json
{
    "patient_name": "John Doe",
    "x_ray": ["Chest", "Knee Joint"],
    "ultrasound_scan": ["Abdominal"],
    "ct_scan": ["Head"],
    "mri": ["Brain"]
}
```

**Sample Response**:
- On Success: `201 Created`
  ```json
  {
      "message": "Medical data submitted successfully"
  }
  ```

- On Validation Error: `422 Unprocessable Entity`
  ```json
  {
      "error": "Validation failed",
      "details": {
          "x_ray.0": ["The selected x_ray.0 is invalid."]
      }
  }
  ```

- On Internal Server Error: `500 Internal Server Error`
  ```json
  {
      "error": "An internal server error occurred"
  }
  ```

## Installation

1. Clone the repository:
    ```bash
    git clone <repository_url>
    ```
2. Navigate to the project directory:
    ```bash
    cd medical-test-management
    ```
3. Install the dependencies:
    ```bash
    composer install
    ```
4. Configure your environment settings in the `.env` file.

## Usage

1. Run the migrations:
    ```bash
    php artisan migrate
    ```
2. Start the application:
    ```bash
    php artisan serve
    ```

## Testing

Use tools like Postman or cURL to test the API endpoints.



