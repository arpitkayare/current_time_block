<?php

namespace Drupal\current_time_block;

/**
 * Class returns the current time base on the timezone.
 */
class GetCurrentTime {

  /**
   * Method gets the current time based on the timezone provided.
   */
  public function getCurrentTime($time_zone) {
    $current_date_time = [];
    $date_time = new \DateTime("now", new \DateTimeZone($time_zone));
    $current_date_time['time'] = $date_time->format('h:i a');
    $current_date_time['date'] = $date_time->format('jS M, Y');
    return $current_date_time;
  }

}
