<h3>bitcoin_cryptocurrency install</h3>

<ol>
<li>copy and rename docker-compose.yml.example to docker-compose.yml</li>
<li>copy and rename .env.example to .env</li>
<li>docker-compose up -d</li>
<li>docker exec -ti bitcoin_cryptocurrency_web_1 /bin/bash</li>
<li>cd /var/www/html</li>
<li>composer install</li>
<li>php artisan key:generate</li>
<li>php artisan migrate</li>
<li> chmod 777 -R /var/www/html/storage</li>
<li> chmod 777 -R /var/www/html/bootstrap</li>
</ol>