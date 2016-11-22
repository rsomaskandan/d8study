<?php

/**
 * @file
 * Contains \Drupal\day3\Form\Day3Form.
 */

namespace Drupal\day3\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class Day3Form extends ConfigFormBase {

  /**
   * {@inheritdoc}.
   */
  public function getFormId() {
    return 'day3';
  }

  /**
   * {@inheritdoc}.
   */
  public function buildForm(array $form, FormStateInterface $form_state) { 
  $form = parent::buildForm($form, $form_state); 
  $config = $this->config('day3.settings'); 
  $form['email'] = [ 
    '#type' => 'email', 
    '#title' => $this->t('Your .com email address.'), 
    '#default_value' => $config->get('email_address') 
  ]; 

  $form['name'] = [ 
    '#type' => 'textfield', 
    '#title' => $this->t('Your Name'), 
    '#default_value' => $config->get('s_name') 
  ]; 

  $form['gender'] = [ 
    '#type' => 'radios', 
    '#title' => $this->t('Your Gender'), 
    '#default_value' => $config->get('gender'),
    '#options' => array(0 => $this->t('Male'), 1 => $this->t('Female')),
  ]; 

  $form['choices'] = [ 
    '#type' => 'select', 
    '#title' => $this->t('Your number choices'), 
    '#default_value' => $config->get('choices'),
    '#options' => [
    '1' => $this->t('One'),
    '2' => [
      '2.1' => $this->t('Two point one'),
      '2.2' => $this->t('Two point two'),
    ],
    '3' => $this->t('Three'),
  ], 
  ]; 

  return $form; 
} 

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if (strpos($form_state->getValue('email'), '.com') === FALSE) {
      $form_state->setErrorByName('email', $this->t('This is not a .com email address.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('day3.settings');
    $config->set('email_address', $form_state->getValue('email'));
    $config->set('s_name', $form_state->getValue('name'));
    $config->set('gender', $form_state->getValue('gender'));
    $config->set('choices', $form_state->getValue('choices'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}. 
   */ 
  protected function getEditableConfigNames() { 
    return ['day3.settings']; 
  } 

}
