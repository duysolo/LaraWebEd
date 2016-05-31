<?php namespace App\Http\Controllers\Admin\AdminFoundation;

trait CategoryWithSubText
{
    /*
     * Get all categories with children node.
     * @param $request: instance of Request
     * @param $parentId: parent_id.
     * @return array
     * */
    private function _recursiveGetCategories($object, $parentId, $orderBy = 'global_title', $orderType = 'ASC')
    {
        $results = [];
        $getByFields = [
            'parent_id' => ['compare' => '=', 'value' => $parentId],
        ];
        $categories = $object->searchBy($getByFields, [$orderBy => $orderType], true, 0);

        foreach ($categories as $key => $row) {
            $row->childrenCategories = $this->_recursiveGetCategories($object, $row->id, $orderBy, $orderType);
            array_push($results, $row);
        }
        return $results;
    }

    /*
     * When get categories, auto add sub text to each element.
     * @param $categories: A list categories
     * @param $level: level of category
     * @param $subText: sub text
     * @return array
     * */
    private function _recursiveShowCategoriesWithSub($categories, $level = 0, $subText = '——')
    {
        $result = [];

        $childText = '';
        if ($level > 0) {
            for ($i = 0; $i < $level; $i++) {
                $childText .= $subText;
            }
        }
        foreach ($categories as $key => $row) {
            $data = [
                'id' => $row->id,
                'parent_id' => $row->parent_id,
                'global_title' => $row->global_title,
                'sub_title' => $childText,
                'status' => $row->status,
                'created_at' => $row->created_at->toDateTimeString(),
                'updated_at' => $row->updated_at->toDateTimeString(),
            ];
            array_push($result, $data);
            if (sizeof($row->childrenCategories) > 0) {
                $childrenCategories = $this->_recursiveShowCategoriesWithSub($row->childrenCategories, $level + 1, $subText);
                foreach ($childrenCategories as $keyChild => $childRow) {
                    array_push($result, $childRow);
                }
            }
        }
        return $result;
    }

    /**
     * Function get all categories
     * @var optional: categoryId:
     * Get all categories that parent_id equal to categoryId
     * @return array object
     **/
    private function _recursiveGetCategoriesDataTable($categories, $childText = 0, $urlLink = 'categories')
    {
        $result = [];

        $child = '';
        if ($childText > 0) {
            for ($i = 0; $i < $childText; $i++) {
                $child .= '——';
            }
        }

        foreach ($categories as $key => $row) {
            $link = asset($this->adminCpAccess . '/' . $urlLink . '/edit/' . $row->id . '/' . $this->defaultLanguageId);
            $removeLink = asset($this->adminCpAccess . '/' . $urlLink . '/delete/' . $row->id);
            $viewPostsLink = asset($this->adminCpAccess . '/' . $urlLink . '/view-posts/' . $row->id);

            $status = '<span class="label label-success label-sm">Activated</span>';
            if ($row->status != 1) {
                $status = '<span class="label label-danger label-sm">Disabled</span>';
            }

            array_push($result, [
                '<input type="checkbox" name="id[]" value="' . $row->id . '">',
                $row->id,
                '<span class="the-before-text">' . $child . '&nbsp;</span>' . $row->global_title,
                $row->page_template,
                $status,
                $row->order,
                $row->created_at->toDateTimeString(),
                '<a class="fast-edit" title="Fast edit">Fast edit</a>',
                '<a href="' . $link . '" class="btn btn-outline green btn-sm"><i class="icon-pencil"></i></a>' .
                '<button type="button" data-ajax="' . $removeLink . '" data-method="DELETE" data-toggle="confirmation" class="btn btn-outline red-sunglo btn-sm ajax-link"><i class="fa fa-trash"></i></button>' .
                '<a href="' . $viewPostsLink . '" class="btn btn-outline green btn-sm"><i class="icon-eye"></i></a>',
            ]);
            if (sizeof($row->childrenCategories) > 0) {
                $childrenCategories = $this->_recursiveGetCategoriesDataTable($row->childrenCategories, $childText + 1, $urlLink);
                foreach ($childrenCategories as $key2 => $childRow) {
                    array_push($result, $childRow);
                }
            }
        }
        return $result;
    }

    /**
     * Function get all categories
     * @var optional: categoryId:
     * Get all categories that parent_id equal to categoryId
     * @return string (use for select box)
     **/
    private function _recursiveGetCategoriesSelectSrc($object, $parentId, $orderBy = 'id', $orderType = 'asc', $childText = 0, $selectedNode = 0, $exceptIds = [])
    {
        $updateTo = '';
        $child = '';
        for ($i = 0; $i < $childText; $i++) {
            $child .= '——';
        }

        $categories = $object->where('parent_id', '=', $parentId);
        if (sizeof($exceptIds) > 0) {

            $categories = $categories->whereNotIn('id', $exceptIds);
        }
        $categories = $categories->orderBy($orderBy, $orderType)->get();

        foreach ($categories as $key => $row) {
            $updateTo .= '<option value="' . $row->id . '"' . (($row->id == $selectedNode) ? ' selected="selected"' : '') . '>' . $child . ' ' . $row->global_title . '</option>';
            $updateTo .= $this->_recursiveGetCategoriesSelectSrc($object, $row->id, $orderBy, $orderType, $childText + 1, $selectedNode, $exceptIds);

        }
        return $updateTo;
    }
}
