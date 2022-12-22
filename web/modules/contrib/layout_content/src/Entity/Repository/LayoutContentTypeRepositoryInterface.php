<?php

declare(strict_types = 1);

namespace Drupal\layout_content\Entity\Repository;

use Drupal\layout_content\Entity\LayoutContentTypeInterface;

/**
 * Provides an interface for the layout content type repository.
 */
interface LayoutContentTypeRepositoryInterface {

  /**
   * Find the layout content type by ID.
   *
   * @param string $id
   *   The layout content type ID.
   *
   * @return \Drupal\layout_content\Entity\LayoutContentTypeInterface|null
   *   The layout content type entity or NULL if it doesn't exist.
   */
  public function find(string $id): ?LayoutContentTypeInterface;

  /**
   * Find all the layout content types.
   *
   * @return \Drupal\layout_content\Entity\LayoutContentTypeInterface[]
   *   A list of layout content types.
   */
  public function findAll(): array;

}
