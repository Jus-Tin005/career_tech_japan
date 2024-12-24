## Instruction Guide

Follow the steps below to set up the project:

1. **Copy and Rename the Environment File**  
   - Duplicate the `.env.example` file and rename it to `.env`.

2. **Configure the Database**  
   - Set up your database credentials in the `.env` file:
     ```env
     DB_DATABASE=career_tech_japan
     DB_USERNAME=db_username
     DB_PASSWORD=db_password
     ```

3. **Generate a New Application Key**  
   - Run the following command to generate a new application key:
     ```bash
     php artisan key:generate
     ```

4. **Migrate the Database**  
   - Execute the following command to run database migrations:
     ```bash
     php artisan migrate
     ```

5. **Install Missing Dependencies**  
   - If there are any missing dependencies, resolve them by running:
     ```bash
     composer update
     ```

6. **Seed the Database**  
   - Populate the database with default data by executing:
     ```bash
     php artisan db:seed
     ```

7. **Start the Development Server**  
   - Finally, start the server using this command:
     ```bash
     php artisan serve
     ```

8. **Credentials**  
   - The default login credentials are:
     ```plaintext
     email = admin@admin.com
     password = password
     ```

9. **API Endpoints**  
   Below are the available API endpoints:

    **Company** 
   - **GET** `api/companies` — Retrieve list of companies  
   - **POST** `api/companies` — Create a new company  
   - **GET** `api/companies/{company}` — Retrieve a specific company  
   - **POST** `api/companies-update/{company}` — Update a specific company  
   - **DELETE** `api/companies/{company}` — Delete a specific company  
     

    **Employee** 
   - **GET** `api/employees` — Retrieve list of employees  
   - **POST** `api/employees` — Create a new employee  
   - **GET** `api/employees/{employee}` — Retrieve a specific employee  
   - **POST** `api/employees-update/{employee}` — Update a specific employee  
   - **DELETE** `api/employees/{employee}` — Delete a specific employee   
     

    **Authentication** 
   - **POST** `api/login` — Login a user  
   - **POST** `api/register` — Register a new user  
    

    **User** 
   - **GET** `api/users` — Retrieve list of users  
    

10. **If Image Did Not Display**  
   - If there are any missing image display, resolve them by running:
     ```bash
     php artisan storage:link
     ```

You’re now ready to use the application!
