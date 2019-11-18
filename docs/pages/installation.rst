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

See more on :ref:`configuration` page.

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

Step 5
~~~~~~

Import the bundle routes in your application:

Create `cas.yaml` in `config/routes` and add:

.. code:: yaml

    casbundle:
        resource: '@CasBundle/Controller/'
        type:     annotation
