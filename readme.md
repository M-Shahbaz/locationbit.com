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

[mapping]
    -hours

[keys]
# Generating Public and Private Keys
# Generate the private key with this OpenSSL command (enter a password):
# openssl genrsa -out private.pem 2048
# To extract the public key file, type the following:
# openssl rsa -in private.pem -outform PEM -pubout -out public.pem

# Generating ES256 keys
# https://learn.akamai.com/en-us/webhelp/iot/jwt-access-control/GUID-C3B1D111-E0B5-4B3B-9FF0-06D48CF40679.html
# openssl ecparam -name secp256k1 -genkey -noout -out ec-secp256k1-priv-key.pem
# openssl ec -in ec-secp256k1-priv-key.pem -pubout > ec-secp256k1-pub-key.pem
# Convert to single line: awk -v ORS='\\n' '1' ec-secp256k1-priv-key.pem
# https://hasura.io/blog/next-js-jwt-authentication-with-next-auth-and-integration-with-hasura/