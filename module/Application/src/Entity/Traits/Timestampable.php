<?php
namespace Application\Entity\Traits;

use DateTime;

/**
 * Timestampable
 */
trait Timestampable
{
    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updated_at;

    /**
     * Returns the creation date.
     * @return DateTime|null
     */
    public function getDateCreated(): ?DateTime
    {
        return $this->created_at;
    }

    /**
     * Sets creation date.
     * @param DateTime $created_at
     * @return self
     */
    public function setDateCreated(DateTime $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Returns the date updated.
     * @return DateTime|null
     */
    public function getDateUpdated(): ?DateTime
    {
        return $this->updated_at;
    }

    /**
     * Sets date of update.
     * @param DateTime $updated_at
     * @return self
     */
    public function setDateUpdated(DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
