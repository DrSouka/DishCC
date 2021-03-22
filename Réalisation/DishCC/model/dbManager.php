<?php

/**
 * @param string[]|string $targetedDatas sql fields to return
 * @param string $table sql table
 * @param string[] $targetedElements [field => value]
 *
 * @return array|false|null
 */
function select($targetedDatas, $table, $targetedElements = []){
  global $db;
  $query = 'SELECT '. sqlTextSELECT_Constructor($targetedDatas) .' FROM '. $table;
  if(!empty($targetedElements)){
    $query .= ' WHERE '. sqlTextWHERE_Constructor($targetedElements);
  }

  $params = array_values($targetedElements);

  return $db->select($query,$params);
}

/**
 * @param string[] $newDatas [field => value]
 * @param string $table sql table
 *
 * @return int
 */
function insert($newDatas = [], $table){
  global $db;

  $query = 'INSERT INTO '. $table .' (';

  foreach($newDatas as $field => $newData){
    $fieldList[] = '`'. $field .'`';
    $dataTags[] = '?';
    $dataList[] = $newData;
  }

  $query .= implode(', ', $fieldList) .') VALUES ('. implode(', ', $dataTags). ')';
  $params = array_values($dataList);

  return $db->insert($query,$params);
}

/**
 * @param string[] $newDatas [field => value]
 * @param string $table sql table
 * @param int $id element id
**/
function update($newDatas = [], $table, $id){
  global $db;
  $update = $params = [];

  foreach($newDatas as $field => $newData){
    $update[] = $field ." = ?";
    $params[] = $newData;
  }
  $params[] = $id;
  $query = 'UPDATE '. $table .' SET '. implode(', ', $update) .' WHERE id = ?';

  return $db->update($query,$params);
}

/**
 * @param string[] $targetedDatas sql fields targeted
 *
 * @return string
 */
function sqlTextSELECT_Constructor($targetedDatas){
  $sqlTextDataSELECT = [];

  if(is_array($targetedDatas)){
    foreach($targetedDatas as $targetedData){
      $sqlTextDataSELECT[] = $targetedData;
    }
  }else{
    $sqlTextDataSELECT[] = $targetedDatas;
  }

  return implode(', ', $sqlTextDataSELECT);
}

/**
 * @param string[] $targetedElements [field => $value]
 *
 * @return string
 */
function sqlTextWHERE_Constructor($targetedElements){
  $sqlTextDataWHERE = [];

  foreach($targetedElements as $field => $value){
    $sqlTextDataWHERE[] = $field .' = ?';
  }

  return implode(' AND ', $sqlTextDataWHERE);
}
