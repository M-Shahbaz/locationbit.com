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
        Require all denied
        Require ip 127.0.0.1 185.209.229.26 173.245.48.0/20 103.21.244.0/22 103.22.200.0/22 103.31.4.0/22 141.101.64.0/18 108.162.192.0/18 190.93.240.0/20 188.114.96.0/20 197.234.240.0/22 198.41.128.0/17 162.158.0.0/15 104.16.0.0/13 104.24.0.0/14 172.64.0.0/13 131.0.72.0/22
	</Proxy>
        ProxyRequests On
        ProxyPass /adminer !
        ProxyPass /api/auth http://localhost:3000/api/auth
        ProxyPass /api !
        ProxyPass / http://localhost:3000/
        ProxyPassReverse / http://localhost:3000/

        <RequireAll>
            Require all denied
            Require ip 127.0.0.1 185.209.229.26 173.245.48.0/20 103.21.244.0/22 103.22.200.0/22 103.31.4.0/22 141.101.64.0/18 108.162.192.0/18 190.93.240.0/20 188.114.96.0/20 197.234.240.0/22 198.41.128.0/17 162.158.0.0/15 104.16.0.0/13 104.24.0.0/14 172.64.0.0/13 131.0.72.0/22
        </RequireAll>

[server-conf]
    nano /etc/apache2/mods-available/mpm_prefork.conf