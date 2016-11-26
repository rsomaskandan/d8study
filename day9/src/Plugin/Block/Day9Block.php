<?php

/**
 * @file
 * Contains \Drupal\day9\Plugin\Block\Day9Block.
 */

namespace Drupal\day9\Plugin\Block;

use Drupal\Core\Block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Annotation\Translation;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Day9: configurable text string' block.
 *
 * Drupal\block\BlockBase gives us a very useful set of basic functionality for
 * this configurable block. We can just fill in a few of the blanks with
 * defaultConfiguration(), blockForm(), blockSubmit(), and build().
 *
 * @Block(
 *   id = "day9_block",
 *   admin_label = @Translation("Title of first block"),
 *   category = @Translation("Day9")
 * )
 */
class Day9Block extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'block_day9_string' => $this->t('A default value. This block was created at %time', ['%time' => date('c')]),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['block_day9_string_text'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Block contents'),
      '#size' => 60,
      '#description' => $this->t('This text will appear below the example block.'),
      '#default_value' => $this->configuration['block_day9_string'],
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['block_day9_string']
      = $form_state->getValue('block_example_day9_text');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'markup',
      '#markup' => $this->configuration['block_day9_string'],
      '#attached' => [
        'library' => [
          'day9/day9'
        ],
      ],
    ];
  }

}
