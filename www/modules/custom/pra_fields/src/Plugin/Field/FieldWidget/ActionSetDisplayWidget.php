<?php
/**
 * @file
 * Contains \Drupal\pra_fields\Plugin\Field\FieldWidget\ActionSetDisplayWidget.
 */

namespace Drupal\pra_fields\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\pra_fields\ActionSet;

/**
 * Plugin implementation of the 'action_set_display' widget.
 *
 * @FieldWidget (
 *   id = "action_set_display",
 *   label = @Translation("ActionSetDisplay widget"),
 *   field_types = {
 *     "action_set_display"
 *   }
 * )
 */
class ActionSetDisplayWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(

    FieldItemListInterface $items,
    $delta,
    array $element,
    array &$form,
    FormStateInterface $form_state
  ) {
    $ActionSet = new ActionSet;
    $fields = $ActionSet->actionSetFields();
    foreach ($fields as $field) {
      $element[$field] = array(
        '#type' => 'checkbox',
        '#title' => t(ucfirst($field)),
        '#default_value' => isset($items[$delta]->{$field}) ? $items[$delta]->{$field} : 1,
        '#attributes' => [
          'display-label-value' => [$field],
          'display-label-control' => ['true'],
        ],
      );
    };

    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
        '#attributes' => array('display-label-wrapper' => 'true'),
        // '#attributes' => array('class' => array('container-inline')),
      );
    }
    return $element;
  }
}
