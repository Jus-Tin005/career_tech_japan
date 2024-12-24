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

You’re now ready to use the application!
