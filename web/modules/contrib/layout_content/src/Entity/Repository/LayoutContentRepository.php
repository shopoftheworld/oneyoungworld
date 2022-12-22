<?php

declare(strict_types = 1);

namespace Drupal\layout_content\Entity\Repository;

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\layout_content\Entity\LayoutContentInterface;

/**
 * Provides a layout content repository.
 */
class LayoutContentRepository implements LayoutContentRepositoryInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructor for LayoutContentRepository.
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
  public function find(int $id): ?LayoutContentInterface {
    return $this->entityTypeManager
      ->getStorage('layout_content')
      ->load($id);
  }

  /**
   * {@inheritdoc}
   */
  public function findByRevision(int $revision_id): ?LayoutContentInterface {
    return $this->entityTypeManager
      ->getStorage('layout_content')
      ->loadRevision($revision_id);
  }

  /**
   * {@inheritdoc}
   */
  public function findByType(string $type): array {
    return $this->entityTypeManager
      ->getStorage('layout_content')
      ->loadByProperties(['type' => $type]);
  }

  /**
   * {@inheritdoc}
   */
  public function findAll(): array {
    return $this->entityTypeManager
      ->getStorage('layout_content')
      ->loadMultiple();
  }

}
