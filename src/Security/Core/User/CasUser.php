<?php

declare(strict_types=1);

namespace drupol\CasBundle\Security\Core\User;

/**
 * Class CasUser.
 */
final class CasUser implements CasUserInterface
{
    /**
     * The user storage.
     *
     * @var array
     */
    private $storage;

    /**
     * CasUser constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->storage = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        return (string) $this->getUsername();
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        // null
    }

    public function getAssuranceLevel()
    {
        return $this->getAttribute('assuranceLevel');
    }

    /**
     * Get a value.
     *
     * @param string $key
     *   The key.
     * @param null $default
     *
     * @return mixed
     *   The value.
     */
    public function getAttribute($key, $default = null)
    {
        return $this->getStorage()['attributes'][$key] ?? $default;
    }

    public function getAttributes(): array
    {
        return $this->getStorage()['attributes'] ?? [];
    }

    /**
     * {@inheritdoc}
     */
    public function getDepartmentNumber()
    {
        return $this->getAttribute('departmentNumber');
    }

    /**
     * {@inheritdoc}
     */
    public function getDomain()
    {
        return $this->getAttribute('domain');
    }

    /**
     * {@inheritdoc}
     */
    public function getDomainUsername()
    {
        return $this->getAttribute('domainUsername');
    }

    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->getAttribute('email');
    }

    /**
     * {@inheritdoc}
     */
    public function getEmployeeNumber()
    {
        return $this->getAttribute('employeeNumber');
    }

    /**
     * {@inheritdoc}
     */
    public function getEmployeeType()
    {
        return $this->getAttribute('employeeType');
    }

    /**
     * {@inheritdoc}
     */
    public function getFirstName()
    {
        return $this->getAttribute('firstName');
    }

    /**
     * {@inheritdoc}
     */
    public function getGroups()
    {
        return $this->getAttribute('groups');
    }

    /**
     * {@inheritdoc}
     */
    public function getLastName()
    {
        return $this->getAttribute('lastName');
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->getAttribute('locale');
    }

    /**
     * {@inheritdoc}
     */
    public function getLoginDate()
    {
        return $this->getAttribute('loginDate');
    }

    /**
     * {@inheritdoc}
     */
    public function getOrgId()
    {
        return $this->getAttribute('orgId');
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getPgt(): ?string
    {
        return $this->getAttribute('proxyGrantingTicket');
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        $default = ['ROLE_CAS_AUTHENTICATED'];

        if ([] !== $roles = $this->getGroups()) {
            if (isset($roles['group'])) {
                return array_merge($roles['group'], $default);
            }
        }

        return $default;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getSso()
    {
        return $this->getAttribute('sso');
    }

    /**
     * {@inheritdoc}
     */
    public function getStrengths()
    {
        return $this->getAttribute('strengths');
    }

    /**
     * {@inheritdoc}
     */
    public function getTelephoneNumber()
    {
        return $this->getAttribute('telephoneNumber');
    }

    /**
     * {@inheritdoc}
     */
    public function getTeleworkingPriority()
    {
        return $this->getAttribute('teleworkingPriority');
    }

    /**
     * {@inheritdoc}
     */
    public function getTicketType()
    {
        return $this->getAttribute('ticketType');
    }

    /**
     * {@inheritdoc}
     */
    public function getUid()
    {
        return $this->getAttribute('uid');
    }

    /**
     * {@inheritdoc}
     */
    public function getUser()
    {
        return $this->getStorage()['user'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->getUser();
    }

    /**
     * Get the storage.
     *
     * @return array
     */
    private function getStorage()
    {
        return $this->storage;
    }
}
