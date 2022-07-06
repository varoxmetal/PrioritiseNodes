function reorder_tree_r(&$children, $target) {
    $order = [];
    $should_sort = false;
    foreach ($children as $i => &$child) {
        $order[$i] = false;
        if (array_key_exists("children", $child) &&
            reorder_tree_r($child["children"], $target) ||
            $child["val"] === $target) {
            $order[$i] = true;
            $should_sort = true;
        }
    }
    if ($should_sort) {
        $priority = [];
        $non_priority = [];
        for ($i = 0; $i < count($children); $i++) {
            if ($order[$i]) {
                $priority[]= $children[$i];
            }
            else {
                $non_priority[]= $children[$i];
            }
        }
        $children = array_merge($priority, $non_priority);
    }
    return $should_sort;
}
function prioritize_nodes(array $tree, $target_val): array{
    if (!$tree || !array_key_exists("children", $tree)) {
        return $tree;
    }
    reorder_tree_r($tree["children"], $target_val);
    return $tree;
}
