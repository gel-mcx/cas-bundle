Installation
============

This package does not yet have a Symfony Flex recipe. Installation steps must be done manually.


Step 1
~~~~~~

The easiest way to install it is through Composer_

.. code-block:: bash

    composer require drupol/cas-bundle

Step 2
~~~~~~

Add the line `drupol\\CasBundle\\CasBundle::class => ['all' => true],` to `config/bundles.php` array.

Step 3
~~~~~~

Recursively copy the content of the `Resources` directory in `config/` folder.

See more on :ref:`configuration` page.

Step 4
~~~~~~

Register new firewall for CAS authentication, e.g.

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
