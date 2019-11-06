# CAS Bundle

A bundle for Symfony 4 that let you use a CAS server for users authentication.

## Installation

This package does not yet have Symfony Flex recipe. Installation steps must be done manually.

### Step 1

Run `composer require drupol/cas-bundle`

### Step 2

Add the line `drupol\CasBundle\CasBundle::class => ['all' => true],` to `config/bundles.php` array.

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
        guard:
            provider: cas
            authenticators:
                - cas.guardauthenticator
```

## Package configuration

### Configuration parameters

Parameter Name | Required | Type | Default Value | Notes
--- | --- | --- | --- | ---
base_url | Yes | string | n/a | The base URL.

### Example bundle configuration file

```yaml
cas:
  base_url: https://localhost:8443/cas
  protocol:
    login:
      path: /login
      allowed_parameters:
        - service
        - renew
        - gateway
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
      path: /proxy
      allowed_parameters:
        - targetService
        - pgt
    proxyValidate:
      path: /p3/proxyValidate
      allowed_parameters:
        - service
        - ticket
      default_parameters:
        format: XML
```

### Example security configuration file

```yaml
security:
    providers:
        cas:
            id: cas.userprovider
    firewalls:
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            anonymous: true
            provider: cas.userprovider
            switch_user: true
            pattern: ^/
            guard:
                authenticators:
                    - cas.guardauthenticator
    access_control:
        - { path: ^/api, role: ROLE_CAS_AUTHENTICATED }
```
