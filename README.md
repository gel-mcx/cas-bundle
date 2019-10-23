# CAS Bundle

## Installation

### Step 1

Run `composer require drupol/cas-bundle`

### Step 2

Add the line `drupol\CasBundle\CasBundle::class => ['all' => true]` to `config/bundles.php` array.

### Step 3

Create file `cas.yaml` file in `config/packages/` folder and populate it with bundle configuration. Refer to [Package Configuration](#package-configuration) section for this step.

### Step 4

Edit `security.yaml` file in `config/packages/` folder. Add new user provider, e.g.

```yaml
providers:
    cas:
        id: cas.userprovider
```

and register new firewall, e.g.

```yaml
firewalls:
    main:
        anonymous: ~
        guard:
            provider: cas
            authenticators:
              - cas.guardauthenticator
```

## Package configuration

### Example bundle configuration file

```yaml
cas:
  base_url: https://localhost:8443/cas
  protocol:
    login:
      allowed_parameters:
        - service
        - renew
        - gateway
      path: /login
    serviceValidate:
      allowed_parameters:
        - service
        - ticket
        - pgtUrl
        - renew
        - format
      default_parameters:
        format: JSON
        pgtUrl: cas_bundle_proxy_callback
      path: /p3/serviceValidate
    logout:
      allowed_parameters:
        - service
      path: /logout
    proxy:
      allowed_parameters:
        - targetService
        - pgt
      path: /proxy
    proxyValidate:
      allowed_parameters:
        - service
        - ticket
      default_parameters:
        format: XML
      path: /p3/proxyValidate
```

### Example Security Configuration File

```yaml
security:
    role_hierarchy:
        ROLE_DEVELOPER: [ROLE_ADMIN, ROLE_ALLOWED_TO_SWITCH]
        ROLE_ADMIN: [ROLE_USER]
        ROLE_USER: []
    providers:
        cas:
            id: cas.provider
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            anonymous: ~
            switch_user: true
            pattern: ^/
            logout:
                path: /logout
                invalidate_session: true
            guard:
                authenticators:
                    - cas.guardauthenticator
    access_control:
        - { path: ^/logout, role: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/, role: ROLE_USER }
```
