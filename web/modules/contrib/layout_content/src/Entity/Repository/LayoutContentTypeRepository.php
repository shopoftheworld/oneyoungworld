<?php

declare(strict_types = 1);

namespace Drupal\layout_content\Entity\Repository;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\layout_content\Entity\LayoutContentTypeInterface;

/**
 * Provides a layout content type repository.
 */
class LayoutContentTypeRepository implements LayoutContentTypeRepositoryInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructor for LayoutContentTypeRepository.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function find(string $id): ?LayoutContentTypeInterface {
    return $this->entityTypeManager
      ->getStorage('layout_content_type')
      ->load($id);
  }

  /**
   * {@inheritdoc}
   */
  public function findAll(): array {
    return $this->entityTypeManager
      ->getStorage('layout_content_type')
      ->loadMultiple();
  }

}
