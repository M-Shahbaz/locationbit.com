786/92

(no need) Change: DocumentRoot (restart xampp)
H:\xampp\apache\conf
    -httpd.conf
        -Line 252-253
            locationbit.com

[proxypass]
H:\xampp\apache\conf\extra
    -httpd-proxy.conf
        ProxyRequests On
        ProxyPass /api/auth http://127.0.0.1:3000/api/auth
        ProxyPassReverse /api/auth http://127.0.0.1:3000/api/auth
        ProxyPass /api http://localhost:1212/api
        ProxyPassReverse /api http://localhost:1212/api
        #ProxyPass /api !
        ProxyPass / http://127.0.0.1:3000/
        ProxyPassReverse / http://127.0.0.1:3000/