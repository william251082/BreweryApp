<?php
/**
 * Created by PhpStorm.
 * User: williamdelrosario
 * Date: 2/10/18
 * Time: 12:37 PM
 */

namespace AppBundle\Form;

use AppBundle\Entity\Breweries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

/**
 * Defines the form used to get user-input zipcode.
 *
 */
class ZipcodeForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('zipcode', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6]),
                    new Regex('{\A[1-9][0-9]{3}[ ]?([A-RT-Za-rt-z][A-Za-z]|[sS][BCbcE-Re-rT-Zt-z])\z}')
                ]
            ]);

    }
}
