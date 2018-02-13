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

    $ActionSet = new ActionSet();
    var_dump($ActionSet->ActionSetFields());

    $element['quantity'] = array(
      '#type' => 'checkbox',
      '#title' => t('Quantity'),
      '#default_value' => isset($items[$delta]->quantity) ? $items[$delta]->quantity : 1,
    );
    $element['weight'] = array(
      '#type' => 'checkbox',
      '#title' => t('Weight'),
      '#default_value' => isset($items[$delta]->weight) ? $items[$delta]->weight : 1,
    );
    $element['distance'] = array(
      '#type' => 'checkbox',
      '#title' => t('Distance'),
      '#default_value' => isset($items[$delta]->distance) ? $items[$delta]->distance : 1,
    );
    $element['duration'] = array(
      '#type' => 'checkbox',
      '#title' => t('Duration'),
      '#default_value' => isset($items[$delta]->duration) ? $items[$delta]->duration : 1,
    );
    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
        // '#attributes' => array('class' => array('container-inline')),
      );
    }
    return $element;
  }
}
