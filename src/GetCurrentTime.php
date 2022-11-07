<?php

namespace Drupal\current_time_block;

use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Class returns the current time base on the timezone.
 */
class GetCurrentTime {

  /**
   * The Drupal Date formatter object.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateTimeFormatter;

  /**
   * GetCurrentTime class constructor.
   *
   * @param Drupal\Core\Datetime\DateFormatterInterface $date_time_formatter
   *   Drupal Date formatter service.
   */
  public function __construct(DateFormatterInterface $date_time_formatter) {
    $this->dateTimeFormatter = $date_time_formatter;

  }

  /**
   * Method gets the current time based on the timezone provided.
   */
  public function getCurrentTime($time_zone) {
    $current_date_time = [];
    $date = new DrupalDateTime("now", $time_zone);
    $current_date_time['time'] = $this->dateTimeFormatter->format($date->getTimestamp(), 'custom', 'h:i A', $time_zone);
    $current_date_time['date'] = $this->dateTimeFormatter->format($date->getTimestamp(), 'custom', 'jS M Y', $time_zone);
    return $current_date_time;
  }

}
