<?php

namespace Drupal\oho_group;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\group\Entity\GroupContent;

/**
 * Utility functions for groups and group content.
 */
class GroupService {

  /**
   * Get all groups of the given type which are associated with the entity.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity
   *   The entity.
   * @param array $group_types
   *   An array of group types.
   *
   * @return array
   *   The groups associated with the entity.
   */
  public function getEntityGroups(ContentEntityInterface $entity, array $group_types = []) {
    $group_content_items = GroupContent::loadByEntity($entity);

    // Get all groups associated with the entity.
    $groups = [];
    foreach ($group_content_items as $group_content) {
      $group = $group_content->getGroup();

      // If no group types are selected, add all groups.
      if (empty($group_types)) {
        $groups[] = $group;
      }
      // Only add the group if it is one of the selected group types.
      elseif (in_array($group->bundle(), $group_types)) {
        $groups[] = $group;
      }
    }

    return $groups;
  }

}
