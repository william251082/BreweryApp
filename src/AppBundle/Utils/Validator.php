<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2/10/18
 * Time: 1:00 PM
 */

namespace AppBundle\Utils;

use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * This class is used to integrate simple classes as
 * services.
 *
 */
class Validator
{
    public function validateZipcode(?string $zipcode): string
    {
        if (empty($zipcode)) {
            throw new InvalidArgumentException('The zipcode can not be empty.');
        }

        if (1 !== preg_match('/^[a-z_]+$/', $zipcode)) {
            throw new InvalidArgumentException('The zipcode must contain only latin characters.');
        }

        return $zipcode;
    }
}