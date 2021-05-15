#cache issues on storage
```
chgrp www-data storage -R   
chmod g+rwx storage -R
```
php artisan db:seed --class="\Backend\Database\Seeds\SeedSetupAdmin"
#docker get ip address by container name
docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' container_name_or_id  