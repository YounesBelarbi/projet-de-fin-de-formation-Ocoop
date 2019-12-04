# LexikJWT

## Installation du bundle
composer require lexik/jwt-authentication-bundle

## Création des clés privée/publique
- privée
openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
- publique
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout

## Intégrer le code suivant au firewall du security.yaml
        login:
            pattern:  ^/api/login
            stateless: true
            anonymous: true
            json_login:
                check_path:               /api/login_check
                success_handler:          lexik_jwt_authentication.handler.authentication_success
                failure_handler:          lexik_jwt_authentication.handler.authentication_failure

        api:
            pattern:   ^/api
            stateless: true
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator

## Intégrer le code suivant aux access_control du security.yaml
        - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/api,       roles: IS_AUTHENTICATED_FULLY }

## Test Token
curl -X POST -H "Content-Type: application/json" http://localhost:8001/api/login_check -d '{"username":"culpa","password":"admin"}'