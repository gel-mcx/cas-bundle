Installation
============

This package does not yet have Symfony Flex recipe. Installation steps must be done manually.


Step 1
~~~~~~

The easiest way to install it is through Composer_

.. code-block:: bash

    composer require drupol/cas-bundle

Step 2
~~~~~~

Add the line `drupol\CasBundle\CasBundle::class => ['all' => true],` to `config/bundles.php` array.

Step 3
~~~~~~

Create file `cas.yaml` file in `config/packages/` folder and populate it.

Example of configuration:

.. code:: yaml

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
            - format
            - pgtUrl
            - renew
            - service
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
            - format
            - pgtUrl
            - service
            - ticket
          default_parameters:
            format: XML
            pgtUrl: cas_bundle_proxy_callback

Step 4
~~~~~~

Edit `security.yaml` file in `config/packages/` folder.

Add new user provider, e.g.

.. code:: yaml

    providers:
        cas:
            id: cas.userprovider

and register new firewall, e.g.

.. code:: yaml

    firewalls:
        main:
            guard:
                provider: cas
                authenticators:
                    - cas.guardauthenticator

Example of configuration:

.. code:: yaml

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
                provider: cas
                switch_user: true
                pattern: ^/
                guard:
                    authenticators:
                        - cas.guardauthenticator
        access_control:
            - { path: ^/api, role: ROLE_CAS_AUTHENTICATED }


.. _Composer: https://getcomposer.org

