<?php
namespace Application\Service\Exception;

use Exception;

class EntityNotFoundException extends Exception
{
    /**
     * Static constructor.
     *
     * @param string   $className
     * @param string   $id
     *
     * @return self
     */
    public static function fromClassNameAndIdentifier($className, string $id)
    {
        return new self(
            'Entity of type \'' . $className . '\'' . ($id ? ' for ID ' . $id : '') . ' was not found'
        );
    }
}