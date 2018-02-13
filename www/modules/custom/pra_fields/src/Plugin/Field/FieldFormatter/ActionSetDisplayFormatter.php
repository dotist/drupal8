<?php
/**
 * @file
 * Contains \Drupal\pra_fields\Plugin\Field\FieldFormatter\ActionSetDisplayFormatter.
 */

namespace Drupal\pra_fields\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'action_set_display' formatter.
 *
 * @FieldFormatter (
 *   id = "action_set_display",
 *   label = @Translation("ActionSetDisplay"),
 *   field_types = {
 *     "action_set_display"
 *   }
 * )
 */
class ActionSetDisplayFormatter extends FormatterBase {
  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode = NULL) {
    $elements = array();

    foreach ($items as $delta => $item) {

      $markup = $item->distance;
      $markup .= $item->quantity;
      $markup .= $item->weight;
      $markup .= $item->duration;

      $elements[$delta] = array(
        '#type' => 'markup',
        '#title' => 'markup',
        '#markup' => $markup,
      );
    }

    return $elements;
  }
}
