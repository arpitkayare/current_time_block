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
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country'),
      '#default_value' => $this->config('current_time_block.settings')->get('country'),
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City'),
      '#default_value' => $this->config('current_time_block.settings')->get('city'),
    ];
    $form['time_zone'] = [
      '#type' => 'select',
      '#title' => $this->t('Timezone'),
      '#default_value' => $this->config('current_time_block.settings')->get('time_zone'),
      '#options' => [
        'america/chicago' => 'America/Chicago',
        'america/new_york' => 'America/New_York',
        'asia/tokyo' => 'Asia/Tokyo',
        'asia/dubai' => 'Asia/Dubai',
        'asia/kolkata' => 'Asia/Kolkata',
        'europe/amsterdam' => 'Europe/Amsterdam',
        'europe/oslo' => 'Europe/Oslo',
        'europe/london' => 'Europe/London'
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
