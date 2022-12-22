<?php

declare(strict_types = 1);

namespace Drupal\layout_content\Entity;

use Drupal\Core\Entity\RevisionableEntityBundleInterface;

interface LayoutContentTypeInterface extends RevisionableEntityBundleInterface {

  /**
   * Get the layout.
   *
   * The layout is represented as each top level array value is a row of the
   * layout, and then each value in the child array is the region.
   *
   * @code
   * [
   *   [
   *     'first' => 'First Region',
   *     'second' => 'Second Region',
   *   ],
   *   [
   *     'third' => 'Third Region',
   *   ],
   * ]
   * @endcode
   *
   * The above code example would render a layout of 2 row, the first two having
   * two regions, and the second row having one region.
   *
   * @return array
   *   The layout representated as an array.
   */
  public function getLayout(): array;

  /**
   * Set the layout
   *
   * @see LayoutContentTypeInterface::getLayout()
   *
   * @param array $layout
   *   The layout.
   *
   * @return self
   *   Returns itself for a fluid interface.
   */
  public function setLayout(array $layout): self;

  /**
   * Get the layout regions.
   *
   * This method flattens the layout rows into just an array of regions that are
   * defined in the layout.
   *
   * @return array
   *   The layout regions.
   */
  public function getLayoutRegions(): array;

  /**
   * Get the icon map.
   *
   * @return array
   *   The icon map is generated from the layout.
   */
  public function getIconMap(): array;

}
