<?php
namespace Drupal\custom_site_settings\Controller;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
class ChangeSiteNameFormController extends ControllerBase {
  /**
   * Form builder service.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;
  /**
   * {@inheritdoc}
   */
  public function __construct(FormBuilderInterface $form_builder) {
    $this->formBuilder = $form_builder;
  }
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('form_builder')
    );
  }
  /**
   * {@inheritdoc}
   */
  public function getForm() {
    $form = $this->formBuilder->getForm('Drupal\custom_site_settings\Form\ChangeSiteNameForm');
    return $form;
  }
}
