<?php

namespace Admingenerator\FormExtensionsBundle\Form\Type;

use Admingenerator\FormExtensionsBundle\Form\EventListener\ReorderCollectionSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * See `Resources/doc/bootstrap-collection/overview.md` for documentation
 *
 * @author Piotr Gołębiewski <loostro@gmail.com>
 */
class BootstrapCollectionType extends AbstractType
{
    private $widget;

    public function __construct($widget)
    {
        $this->widget = $widget;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //$builder->addEventSubscriber(new ReorderCollectionSubscriber());

        parent::buildForm($builder, $options);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['sortable']       = $options['sortable'];
        $view->vars['sortable_field'] = $options['sortable_field'];
        $view->vars['new_label']      = $options['new_label'];
        $view->vars['prototype_name'] = $options['prototype_name'];
        $view->vars['fieldset_class'] = $options['fieldset_class'];
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'sortable'          => false,
            'sortable_field'    => 'position',
            'new_label'         => 's2a_bootstrap_collection.new_label',
            'fieldset_class'    => 'col-md-4',
        ));

        $resolver->setAllowedTypes(array(
            'sortable'        => array('bool'),
            'sortable_field'  => array('string'),
            'new_label'       => array('string'),
            'fieldset_class'  => array('string'),
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'collection';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 's2a_collection_' . $this->widget;
    }
}
