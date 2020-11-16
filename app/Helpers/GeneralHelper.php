<?php

use App\Models\Page;

/**
 * get parent pages
 *
 *
 * @return mixed
 */

function getParentPages()
{
  return \App\Models\Page::where('parent', 0)->orderBy('sort', 'ASC')->get();
}

/**
 * get all parent pages
 *
 *
 * @return mixed
 */

function getPagesTree($parent = 0)
{
  $that = $this;
	$temp_array = array();

	$result = \App\Models\Page::where('parent', $parent)->where('show', 1)->orderBy('sort', 'ASC')->get();

    foreach($result as $element)
    {
      if($element['parent']==$parent)
      {
        $element['subs'] = $this->getParentPages($element['id']);
        $temp_array[] = $element;
      }
    }
    return $temp_array;
}

/**
 * upload file
 *
 *
 * @param $request
 * @param $name
 * @param string $destination
 * @return string
 */
function uploadFile($request, $name, $destination = '')
{
    $image = $request->file($name);
 
    $name = time().'.'.$image->getClientOriginalExtension();
 
    if($destination == '') {
        $destination = public_path('/content');
    }
 
    $image->move($destination, $name);
 
    return $name;
}

/**
 * check directory exists and try to create it
 *
 *
 * @param $directory
 */
function checkImageDirectory($directory)
{
  try {
    if (!file_exists(public_path('content/' . $directory))) {
      mkdir(public_path('content/' . $directory));
      chmod(public_path('content/' . $directory), 0777);
    }
  } catch (\Exception $e) {
    die($e->getMessage());
  }
}