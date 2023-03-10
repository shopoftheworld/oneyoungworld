<?php

declare(strict_types = 1);

namespace Drupal\layout_content\Plugin\Layout;

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\SubformStateInterface;
use Drupal\Core\Layout\LayoutDefault;
use Drupal\layout_content\Entity\LayoutContentInterface;

/**
 * Registers custom layouts as plugins.
 *
 * @Layout(
 *  id = "layout_content__custom_layout",
 *  deriver = "Drupal\layout_content\Plugin\Derivative\CustomLayoutDeriver"
 * )
 */
class CustomLayout extends LayoutDefault {

  /**
   * The layout content entity.
   *
   * @var \Drupal\layout_content\Entity\LayoutContentInterface
   */
  protected $entity;

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return parent::defaultConfiguration() + [
      'layout_serialized' => NULL,
      'layout_revision_id' => NULL,
      'layout_uuid' => NULL,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(
    array $form,
    FormStateInterface $form_state
  ): array {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['layout_form'] = [
      '#type' => 'container',
      '#process' => [[$this, 'processLayoutForm']],
      '#layout' => $this->getEntity(),
    ];

    return $form;
  }

  /**
   * The form processor to render the layout content entity form.
   *
   * @param array $element
   *   The layout form element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return array
   *   The layout entity form element.
   */
  public function processLayoutForm(
    array $element,
    FormStateInterface $form_state
  ): array {
    $layout = $element['#layout'];
    EntityFormDisplay::collectRenderDisplay(
      $this->getEntity(),
      'edit'
    )->buildForm($layout, $element, $form_state);
    $element['revision_log']['#access'] = FALSE;

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(
    array &$form,
    FormStateInterface $form_state
  ): void {
    $layout_form = $form['layout_form'];
    $layout = $layout_form['#layout'];

    $form_display = EntityFormDisplay::collectRenderDisplay(
      $layout,
      'edit'
    );
    $complete_form_state = $form_state instanceof SubformStateInterface
      ? $form_state->getCompleteFormState()
      : $form_state;
    $form_display->extractFormValues(
      $layout,
      $layout_form,
      $complete_form_state
    );
    $form_display->validateFormValues(
      $layout,
      $layout_form,
      $complete_form_state
    );
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(
    array &$form,
    FormStateInterface $form_state
  ): void {
    $layout_form = $form['layout_form'];
    $layout = $layout_form['#layout'];

    $form_display = EntityFormDisplay::collectRenderDisplay(
      $layout,
      'edit'
    );
    $complete_form_state = $form_state instanceof SubformStateInterface
      ? $form_state->getCompleteFormState()
      : $form_state;
    $form_display->extractFormValues(
      $layout,
      $layout_form,
      $complete_form_state
    );

    $this->configuration['layout_serialized'] = serialize($layout);
  }

  /**
   * {@inheritdoc}
   */
  public function build(array $regions): array {
    $build = \Drupal::entityTypeManager()
      ->getViewBuilder('layout_content')
      ->view($this->getEntity());

    foreach ($this->getPluginDefinition()->getRegionNames() as $region_name) {
      if (array_key_exists($region_name, $regions)) {
        $build[$region_name] = $regions[$region_name];
      }
    }

    $build['#layout_definition'] = $this->getPluginDefinition();

    return $build;
  }

  /**
   * Get the layout entity.
   *
   * @return \Drupal\layout_content\Entity\LayoutContentInterface
   *   The layout content entity.
   */
  public function getEntity(): LayoutContentInterface {
    if (!$this->entity) {
      if ($this->configuration['layout_serialized']) {
        return unserialize($this->configuration['layout_serialized']);
      }
      elseif ($this->configuration['layout_revision_id']) {
        return \Drupal::entityTypeManager()
          ->getStorage('layout_content')
          ->loadRevision($this->configuration['layout_revision_id']);
      }
      else {
        return \Drupal::entityTypeManager()
          ->getStorage('layout_content')
          ->create([
            'type' => $this->getDerivativeId(),
          ]);
      }
    }

    return $this->entity;
  }

  /**
   * Save the layout content entity.
   *
   * @see LayoutContentEntityOperations::preSave()
   *
   * @param bool $new_revision
   *   If the layout content entity is a new revision.
   * @param bool $duplicate
   *   If the layout content entity should be duplicated.
   */
  public function save(bool $new_revision, bool $duplicate): void {
    $layout = NULL;
    if (!empty($this->configuration['layout_serialized'])) {
      $layout = unserialize($this->configuration['layout_serialized']);
    }

    if (
      $duplicate
      && empty($layout)
      && !empty($this->configuration['layout_revision_id'])
    ) {
      $layout = \Drupal::entityTypeManager()
        ->getStorage('layout_content')
        ->loadRevision($this->configuration['layout_revision_id']);
    }

    if (!$layout instanceof LayoutContentInterface) {
      return;
    }

    if ($duplicate) {
      $layout->createDuplicate();
    }

    if ($new_revision) {
      $layout->setNewRevision();
    }

    $layout->save();

    $this->configuration['layout_serialized'] = NULL;
    $this->configuration['layout_revision_id'] = $layout->getRevisionId();
    $this->configuration['layout_uuid'] = $layout->uuid();
  }

}
