<?php

declare(strict_types = 1);

namespace Drupal\layout_content\Entity\Repository;

use Drupal\layout_content\Entity\LayoutContentInterface;

/**
 * Provides an interface for the layout content repository.
 */
interface LayoutContentRepositoryInterface {

  /**
   * Find a layout content entity by ID.
   *
   * @param int $id
   *   The layout content ID.
   *
   * @return LayoutContentInterface|null
   *   The layout content entity or NULL if it doesn't exist.
   */
  public function find(int $id): ?LayoutContentInterface;

  /**
   * Find a layout content entity by the revision ID.
   *
   * @param int $revision_id
   *   The entity revision ID.
   *
   * @return LayoutContentInterface|null
   *   The layout content entity or NULL if it doesn't exist.
   */
  public function findByRevision(int $revision_id): ?LayoutContentInterface;

  /**
   * Find the layout content entities by the type (bundle).
   *
   * @param string $type
   *   The layout content entity bundle.
   *
   * @return Drupal\layout_content\Entity\LayoutContentInterface[]
   *   A list of layout content entities.
   */
  public function findByType(string $type): array;

  /**
   * Find all the layout content entities.
   *
   * @return Drupal\layout_content\Entity\LayoutContentInterface[]
   *   A list of layout content entities.
   */
  public function findAll(): array;

}
