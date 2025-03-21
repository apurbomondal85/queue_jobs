## Queue Manage to command

### Make command
php artisan make:command commandName


### Make queue job by command
protected $signature = 'app:generate100queuejobs'
php artisan app:generate100queuejobs

### Queue monitor
php artisan queue:monitor queueName

### Queue Work
php artisan queue:work --queue=default,custom

### Failed Queue retry
php artisan queue:retry --queue=default

### Forcefully Success
php artisan queue:work --queue=default --tries=3

### Clear jobs table
php artisan queue:clear --queue=default

### Clear single failed jobs from table
php artisan queue:forget queueId

### Clear all failed jobs from table
php artisan queue:flush

### for multi cmd generate
for /l %%x in (1, 1, 10) do (
    start cmd
)