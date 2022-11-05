<?php

namespace Drupal\current_time_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\current_time_block\GetCurrentTime;

/**
 * Provides an Current time block.
 *
 * @Block(
 *   id = "site_current_time_block",
 *   admin_label = @Translation("Site current time block"),
 *   category = @Translation("Custom")
 * )
 */
class CurrentTimeBlock extends BlockBase implements ContainerFactoryPluginInterface {


  /**
   * The current time block setting object.
   *
   * @var Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The current time block setting object.
   *
   * @var Drupal\current_time_block\src\GetCurrentTime
   */
  protected $currentTime;

  /**
   * Plugin implementation of the ContainerFactoryPluginInterface.
   *
   *   The container to pull out services used in the plugin.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   Config factory object.
   * @param \Drupal\current_time_block\GetCurrentTime $current_time
   *   An array containing current time and date.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, ConfigFactoryInterface $config_factory, GetCurrentTime $current_time) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentTimeBlock = $config_factory->get('current_time_block.settings');
    $this->currentTime = $current_time;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.factory'),
      $container->get('current_time_block.get_current_time')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $location = [];
    $location['country'] = $this->currentTimeBlock->get('country');
    $location['city'] = $this->currentTimeBlock->get('city');
    $location['current_time_date'] = $this->currentTime->getCurrentTime($this->currentTimeBlock->get('time_zone'));
    $build['#attached']['library'] = ['current_time_block/current_time_block'];
    $build['#theme'] = 'current_time_block';
    $build['#location'] = $location;
    $build['#cache'] = ['tags' => ['config:current_time_block.settings']];
    return $build;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 15;
  }

}
