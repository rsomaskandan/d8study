<?php
/** @file
 *  Contains \Drupal\day9\Day9Controller.
 */

/* defines the namespace for this controller so we can use it elsewhere */

namespace Drupal\day9\Controller;   

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides route responses for day 9 module. 
 */
class Day9Controller extends ControllerBase
{
  /**
   * Returns a simple Hello World page
   *
   * @return array
   *   a very simple renderable array is returned
   */
  public function myMethod()
  {
     $header = [
      $this->t('Header 1'),
      $this->t('Header 2')
    ];
    $rows = [
      [
        'row1Col1',
        'row1Col2'
      ],
      [
        'row2Col1',
        'row2Col2'
      ]
    ];
    $build['content'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('No content created yet.'),
    ];
    return $build;
  }
}
