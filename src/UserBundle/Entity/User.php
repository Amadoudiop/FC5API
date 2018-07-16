<?php

// src/UserBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\AttributeOverride;
use Doctrine\ORM\Mapping\AttributeOverrides;
use Doctrine\ORM\Mapping\Column;
use AdminBundle\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

/**
 * User.
 *
 * @ORM\Table("fos_user")
 * @ORM\Entity
 * @AttributeOverrides({
 *      @AttributeOverride(name="usernameCanonical",
 *          column=@Column(
 *              type     = "string",
 *              length   = 155,
 *          )
 *      ),
 *      @AttributeOverride(name="emailCanonical",
 *          column=@Column(
 *              type     = "string",
 *              length   = 155,
 *          )
 *      )
 * })
 */
class User extends BaseUser
{

    public static $fieldsApiAdmin = [];
    public static $defaultFieldOrder = "id";
    public static $defaultDirOrder = "asc";
    public static $fieldsOrder = [
        'id',
    ];
    public static $fieldsApi = [
        'id',
        'email',
    ];

    const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Returns fields used in the API
     * @return array
     */
    public function serializeEntity(array $fields = [], $stopRecursive = false, $recursive = false)
    {
        $results = [];
        $cc = get_called_class();
        $fieldsApi = !empty($fields) ? $fields : $cc::$fieldsApi;
        foreach ($fieldsApi as $attribute) {
            $getter = 'get' . ucfirst($attribute);
            $value = $this->$getter();
            if(($value instanceof PersistentCollection || $value instanceof ArrayCollection) && !$stopRecursive){
                $value = $cc::serializeEntities($value, [], true);
            }elseif(!$stopRecursive){
                $value = $value->serializeEntity([], true && !$recursive, $recursive);
            }
            $results[$attribute] = $value;
        }
        return $results;
    }

    /**
     * call serializeEntity on array and return array
     *
     * @param       $entities
     * @param array $fields
     * @param bool $stopRecursive
     *
     * @param bool $recursive
     *
     * @return array
     */
    public static function serializeEntities($entities, array $fields = [], $stopRecursive = false, $recursive = false)
    {
        $results = [];
        foreach ($entities as $entity) {
            $results[] = $entity->serializeEntity($fields, $stopRecursive, $recursive);
        }
        return $results;
    }
}
