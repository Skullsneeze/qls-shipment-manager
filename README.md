# QLS - Shipment generator application

This applciation uses the QLS API to generate a shipment based on order information provided by the user. The output will be a combination of the packing slip and the shipping label.
This project can run locally with ease using ddev (preferred and documented below), or can be setup using a more traditional development stack.

## Prerequisites
- A working [DDEV installation](https://ddev.readthedocs.io/en/stable/)

## Installation
To run this application locally please follow the following steps

### 1. Configuring the env file
You will need to set some environment specific variables to get the application to work as expected. To do this first create a copy of the sample .env file:
```shell
cp .env.example .env
```

After copying the file, update the following variables in the new `.env` file.
```text
QLS_API_USER=
QLS_API_PASS=
QLS_COMPANY_ID=
QLS_BRAND_ID=
```

### 2. Starting your ddev instance
Start your DDEV instance using the following command:
```shell
ddev start
```

### 3. Installing Dependencies
Install all required dependencies using composer and npm
```shell
ddev composer install
```
```shell
ddev npm install
```

### 4. Generate the application encryption key
```shell
ddev artisan key:generate
```

### 4. Running database migrations
Run the database migrations to generate the required tables using the following command
```shell
ddev artisan migrate
```

### 6. Compile styles and scripts
```shell
ddev exec npm run build
```

### 7. Visit the application
You should now be able to access the application by visiting https://qls-shipment-manager.ddev.site

## Notes
[Browsershot](https://spatie.be/docs/browsershot/v4/requirements) is used for PDF generation, and might require the installation of additional packages when not using DDEV.
