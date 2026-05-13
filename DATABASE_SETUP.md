# Zenith Legal Advocates - Database Setup Guide

## Database Connection Configuration

Your website has been successfully configured to connect to the "zenithlegal" database. Here's what you need to do:

### Step 1: Create the Database in phpMyAdmin

1. Open phpMyAdmin (usually at `http://localhost/phpmyadmin`)
2. Click on "New" or the "+" icon to create a new database
3. Enter database name: **zenithlegal**
4. Click "Create"

### Step 2: Import the Database Tables

1. In phpMyAdmin, select the "zenithlegal" database
2. Click on the "SQL" tab
3. Copy the entire content from `database_setup.sql` file in this folder
4. Paste it into the SQL query box
5. Click "Go" to execute the query

This will create the `consultations` table where all contact form submissions will be stored.

### Step 3: Verify the Connection

- The database connection file is: `db_connect.php`
- Default settings are configured for XAMPP:
  - Host: localhost
  - Username: root
  - Password: (empty)
  - Database: zenithlegal

**If you need to change these settings**, edit `db_connect.php`:

```php
$db_host = 'localhost';      // Your database host
$db_user = 'root';           // Your database username
$db_pass = '';               // Your database password
$db_name = 'zenithlegal';    // Database name
```

## Files Created/Modified

### New Files:
1. **db_connect.php** - Database connection file
2. **submit_form.php** - Form submission handler
3. **database_setup.sql** - SQL script to create tables
4. **DATABASE_SETUP.md** - This file

### Modified Files:
1. **contact.html** - Updated to submit form data to the database

## How It Works

When a user fills out the contact form on the "Contact" page:
1. The form data is sent to `submit_form.php`
2. The data is validated for required fields and valid email format
3. If valid, the data is inserted into the `consultations` table
4. The user sees a success message
5. You can view all submissions in phpMyAdmin under the `consultations` table

## Viewing Submissions

To view all consultation requests:
1. Open phpMyAdmin
2. Navigate to the "zenithlegal" database
3. Click on the "consultations" table
4. All submissions will be displayed with:
   - Submitter name, email, and phone
   - Subject and message
   - Date and time of submission
   - Status (for filtering)

## Database Table Structure

The `consultations` table has the following fields:
- **id** - Unique identifier (auto-incrementing)
- **name** - Full name of the person
- **email** - Email address
- **phone** - Phone number
- **subject** - Subject of inquiry
- **message** - Detailed message/description
- **created_at** - Timestamp of submission
- **status** - Status tracking (pending, contacted, completed, archived)
- **notes** - Internal notes field for your team

## Security Notes

- All form inputs are validated on the server side
- Use prepared statements to prevent SQL injection
- Consider adding CSRF protection for production
- Always validate and sanitize user input
- Keep database credentials secure (never commit passwords to version control)

## Testing

Test the form submission:
1. Visit the Contact page
2. Fill out the form with test data
3. Submit the form
4. You should see a success message
5. Check phpMyAdmin to verify the data was saved

## Support

If you encounter any issues:
- Check that the "zenithlegal" database exists in phpMyAdmin
- Verify the `consultations` table was created successfully
- Check that your database credentials in `db_connect.php` are correct
- Review the browser console for any error messages
- Check the server logs for detailed error information
