## DPD API Service

Copy the code and deploy on your machine. Double check for DPD env. Once deployed, run:
<pre>
composer install
php artisan migrate
php artisan db:seed
php artisan sync:all
</pre>

This will seed and sync all the data required to make DPD price calculations.