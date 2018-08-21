<h3>bitcoin_cryptocurrency install</h3>

<ol>
<li>docker-compose up -d</li>
<li>docker exec -ti bitcoin_cryptocurrency_web_1 /bin/bash</li>
<li>cd /var/www/html</li>
<li>composer install</li>
<li>php artisan key:generate</li>
<li>php artisan migrate</li>
<li> php artisan db:seed</li>
<li> chmod 777 -R /var/www/html/storage</li>
<li> chmod 777 -R /var/www/html/bootstrap</li>
</ol>