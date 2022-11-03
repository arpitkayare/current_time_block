<?php

namespace Drupal\current_time_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an Current time block.
 *
 * @Block(
 *   id = "site_current_time_block",
 *   admin_label = @Translation("Site current time block"),
 *   category = @Translation("Custom")
 * )
 */
class CurrentTimeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
