# osu!bounties

osu!bounties is a web application where users can request bounties to be put up. After submitting a request, users will be contacted by staff regarding their bounty. Users can also view which bounties have been completed and which are still active. Users may also claim bounties after which they will also be contacted by staff.

## Technology

- Built with Laravel Breeze
- For official Laravel documentation, visit [Laravel Official Documentation](https://laravel.com/docs)

## Setup Instructions

1. Clone the repository.
2. In the root of the project, run:
   ```bash
   npm run build
   ```
   This ensures that all assets load correctly.
3. After building, run the following commands to set up the database:
   ```bash
   php artisan migrate:fresh --seed
   php artisan serve
   ```
4. Your application should now be running and accessible via the address provided by `php artisan serve`.

## Notes

- Since Laravel Breeze is discontinued, you may encounter unexpected issues. Refer to Laravel's official documentation for guidance on troubleshooting.
- Make sure Node.js and Composer are installed before running the setup commands.
