<?php

namespace Drupal\current_time_block\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Current time block settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'current_time_block_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['current_time_block.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config_setting = $this->config('current_time_block.settings');
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $config_setting->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $config_setting->get('city'),
    ];
    $form['time_zone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#default_value' => $config_setting->get('time_zone'),
      '#options' => [
        'America/Chicago' => $this->t('America/Chicago'),
        'America/New_york' => $this->t('America/New_York'),
        'Asia/Tokyo' => $this->t('Asia/Tokyo'),
        'Asia/Dubai' => $this->t('Asia/Dubai'),
        'Asia/Kolkata' => $this->t('Asia/Kolkata'),
        'Europe/Amsterdam' => $this->t('Europe/Amsterdam'),
        'Europe/Oslo' => $this->t('Europe/Oslo'),
        'Europe/London' => $this->t('Europe/London'),
      ],
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('current_time_block.settings')
      ->set('country', $form_state->getValue('country'))
      ->save();
    $this->config('current_time_block.settings')
      ->set('city', $form_state->getValue('city'))
      ->save();
    $this->config('current_time_block.settings')
      ->set('time_zone', $form_state->getValue('time_zone'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
