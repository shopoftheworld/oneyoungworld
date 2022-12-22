<?php

declare(strict_types = 1);

namespace Drupal\layout_content\Form;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityDeleteForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\layout_content\Entity\Repository\LayoutContentRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a layout content type delete form.
 */
class LayoutContentTypeDeleteForm extends EntityDeleteForm implements ContainerInjectionInterface {

  /**
   * The layout content repository.
   *
   * @var \Drupal\layout_content\Entity\Repository\LayoutContentTypeRepositoryInterface
   */
  protected $repository;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static($container->get('layout_content.repository'));
  }

  /**
   * Constructor for LayoutContentTypeDeleteForm.
   *
   * @param \Drupal\layout_content\Entity\Repository\LayoutContentRepositoryInterface $repository
   *   The layout content repository.
   */
  public function __construct(LayoutContentRepositoryInterface $repository) {
    $this->repository = $repository;
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $layouts = $this->repository->findByType($this->entity->id());
    if (!empty($layouts)) {
      $caption = '<p>' . $this->formatPlural(count($layouts), '%label is used by 1 custom layout on your site. You can not remove this layout content type until you have removed all of the %label layouts.', '%label is used by @count custom layouts on your site. You may not remove %label until you have removed all of the %label custom layouts.', ['%label' => $this->entity->label()]) . '</p>';
      $form['description'] = ['#markup' => $caption];
      return $form;
    }
    else {
      return parent::buildForm($form, $form_state);
    }
  }

}
