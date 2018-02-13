<?php

/**
 * @file
 * Contains \Drupal\pra_fields\Plugin\Field\FieldType\ActionSetDisplay.
 */

namespace Drupal\pra_fields\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\pra_fields\ActionSet;

/**
 * Plugin implementation of the 'actionset' field type.
 *
 * @FieldType (
 *   id = "action_set_display",
 *   label = @Translation("ActionSetDisplay"),
 *   description = @Translation("Display settings for the fields of a workout's action set."),
 *   default_widget = "action_set_display",
 *   default_formatter = "action_set_display"
 * )
 */
class ActionSetDisplay extends FieldItemBase {

  protected function fields() {
    $ActionSet = new ActionSet();
    return $ActionSet->ActionSetFields();
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    $array['columns'] = [];
    foreach ($this->fields() as $field) {
      $array['columns'][$field] = [
        'type' => 'int',
        'unsigned' => FALSE,
        'size' => 'tiny',
      ];
    }
    return $array;
    // return array(
    //   'columns' => array(
    //     'quantity' => array(
    //       'type' => 'int',
    //       'unsigned' => FALSE,
    //       'size' => 'tiny',
    //     ),
    //     'weight' => array(
    //       'type' => 'int',
    //       'unsigned' => FALSE,
    //       'size' => 'tiny',
    //     ),
    //     'distance' => array(
    //       'type' => 'int',
    //       'unsigned' => FALSE,
    //       'size' => 'tiny',
    //     ),
    //     'duration' => array(
    //       'type' => 'int',
    //       'unsigned' => FALSE,
    //       'size' => 'tiny',
    //       // 'length' => 1,
    //     ),
    //   ),
    // );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    // $value1 = $this->get('quantity')->getValue();
    // return empty($value1) && empty($value2) && empty($value3);
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    foreach($this->fields() as $field) {

    }
    $properties['quantity'] = DataDefinition::create('integer')
      ->setLabel(t('Quantity'))
      ->setDescription(t('Distance display setting.'));
    $properties['weight'] = DataDefinition::create('integer')
      ->setLabel(t('Weight'))
      ->setDescription(t('Weight display setting.'));
    $properties['distance'] = DataDefinition::create('integer')
      ->setLabel(t('Distance'))
      ->setDescription(t('Distance display setting.'));
    $properties['duration'] = DataDefinition::create('integer')
      ->setLabel(t('Duration'))
      ->setDescription(t('Duration display setting.'));
    return $properties;
  }

}
