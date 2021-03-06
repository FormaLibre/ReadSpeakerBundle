<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FormaLibre\ReadSpeakerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class ConfigureType extends AbstractType
{
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'client_id',
            'text',
            array(
                'label' => 'client_id',
                'constraints' => new NotBlank(),
                'data' => $this->id
            )
        );
    }

    public function getName()
    {
        return 'readspeaker_form';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('translation_domain' => 'platform'));
    }
}
