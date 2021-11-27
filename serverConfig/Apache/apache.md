apachectl configtest

systemctl restart apache2

nano /etc/apache2/sites-available/locationbit.com.conf

[logs]
    tail /var/log/apache2/error.log

[php.ini reload]
    nano /etc/php/7.4/fpm/php.ini
     systemctl restart php7.4-fpm.service

[reverser proxy]
        ProxyRequests On
        ProxyPass /codeTemplate !
        ProxyPass /adminer !
        ProxyPass /phpmyadmin !
        ProxyPass /api/auth http://127.0.0.1:3000/api/auth
        ProxyPassReverse /api/auth http://127.0.0.1:3000/api/auth
        ProxyPass /api/examples http://127.0.0.1:3000/api/examples
        ProxyPassReverse /api/examples http://127.0.0.1:3000/api/examples
        ProxyPass /api http://localhost:1212/api
        ProxyPassReverse /api http://localhost:1212/api

    <Proxy *>
        Require all granted
	</Proxy>
        ProxyRequests On
        ProxyPass /adminer !
        ProxyPass /api/auth http://localhost:3000/api/auth
        ProxyPass /api !
        ProxyPass / http://localhost:3000/
        ProxyPassReverse / http://localhost:3000/


[server-conf]
    nano /etc/apache2/mods-available/mpm_prefork.conf