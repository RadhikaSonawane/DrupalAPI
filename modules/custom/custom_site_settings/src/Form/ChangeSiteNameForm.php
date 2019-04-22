<?php
namespace Drupal\custom_site_settings\Form;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
/**
 * Defines a form that configures site settings.
 */
class ChangeSiteNameForm extends ConfigFormBase {
  /**
   * Site config object.
   *
   * @var \Drupal\Core\Config\Config
   */
  protected $config_site;
  /**
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory service.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->config_site = $config_factory->getEditable('system.site');
  }
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
     return 'custom_change_site_name_form';
  }
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'system.site',
    ];
  }
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $site_name = $this->config_site->get('name');
      $form['site_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Site Name'),
        '#default_value' => t($site_name),
        '#required' => TRUE,
      ];
    return parent::buildForm($form, $form_state);
  }
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $site_name = $form_state->getValue('site_name');
      if (strlen($site_name) < 5) {
        $form_state->setErrorByName('site_name', $this->t('Site name should be longer than five characters'));
      }
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $site_name = $form_state->getValue('site_name');
    if (!empty($site_name)) {
      $this->config_site->set('name', $site_name)->save();
    }
    parent::submitForm($form, $form_state);
  }
}
