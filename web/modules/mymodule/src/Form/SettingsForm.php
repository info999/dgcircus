<?php

namespace Drupal\mymodule\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure mymodule settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'mymodule_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mymodule.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['notify_email'] = [
        '#type' => 'email',
        '#title' => $this->t('Email'),
        '#description' => 'Notifications will be sent to the specified email when the banner posting period expires.',
        '#default_value' => $this->config('mymodule.settings')->get('notify_email'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
//    if ($form_state->getValue('example') != 'example') {
//      $form_state->setErrorByName('example', $this->t('The value is not correct.'));
//    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('mymodule.settings')
      ->set('notify_email', $form_state->getValue('notify_email'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
