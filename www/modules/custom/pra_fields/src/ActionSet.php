<?php
/**
 * @file
 * Contains \Drupal\pra_fields\ActionSet.
 */

namespace Drupal\pra_fields;

/**
 * ActionSetDisplay Functions.
 */
class ActionSet {

  /**
   * {@inheritdoc}
   */
  public $ActionSetEntityTypeId = 'paragraph';

  /**
   * {@inheritdoc}
   */
  public $ActionSetEntityBundle = 'action_set';

  /**
   * {@inheritdoc}
   */
  public function actionSetFields() {
    $entity_type = $this->ActionSetEntityTypeId;
    $bundle = $this->ActionSetEntityBundle;
    $fields =  \Drupal::service('entity_field.manager')->getFieldDefinitions($entity_type, $bundle);
    $return = [];
    // Reduce to custom fields which should have display setting.
    unset($fields['field_exercise']);
    unset($fields['field_display_settings']);
    unset($fields['parent_field_name']);
    foreach ($fields as $i => $field) {
      if ( strpos($i, 'field_') === 0 ) {
        $i = str_replace('field_', '', $i);
        $return[] = $i;
      }
    }
    return $return;
  }

}
