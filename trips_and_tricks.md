#cache issues on storage
```
chgrp www-data storage -R   
chmod g+rwx storage -R
```
php artisan db:seed --class="\Backend\Database\Seeds\SeedSetupAdmin"