<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomFieldsModel extends Model
{
  protected $table            = 'custom_fields';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = 'object';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = [];

  // Dates
  protected $useTimestamps = false;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  function get_email_template_variables_array($related_to, $related_to_id = 0, $is_admin = 0, $user_type = "")
  {
    $tickets_template_variables = $this->get_combined_details($related_to, $related_to_id, $is_admin, $user_type)->getResult();
    $variables_array = array();
    foreach ($tickets_template_variables as $variable) {
      if ($variable->example_variable_name) {
        array_push($variables_array, $variable->example_variable_name);
      }
    }
    return $variables_array;
  }

  function get_combined_details($related_to, $related_to_id = 0, $is_admin = 0, $user_type = "")
  {
    $custom_fields_table = $this->db->prefixTable('custom_fields');
    $custom_field_values_table = $this->db->prefixTable('custom_field_values');

    $where = "";

    //check visibility permission for non-admin users
    if (!$is_admin) {
        $where .= " AND $custom_fields_table.visible_to_admins_only=0";
    }


    //check visibility permission for clients
    if ($user_type === "client") {
        $where .= " AND $custom_fields_table.hide_from_clients=0";
    }


    if (!$related_to_id) {
        $related_to_id = 0;
    }

    $related_to_id = $related_to_id ? $this->db->escapeString($related_to_id) : $related_to_id;

    $sql = "SELECT $custom_fields_table.*,
            $custom_field_values_table.id AS custom_field_values_id, $custom_field_values_table.value
    FROM $custom_fields_table
    LEFT JOIN $custom_field_values_table ON $custom_fields_table.id= $custom_field_values_table.custom_field_id AND $custom_field_values_table.deleted=0 AND $custom_field_values_table.related_to_id = $related_to_id
    WHERE $custom_fields_table.deleted=0 AND $custom_fields_table.related_to = '$related_to' $where
    ORDER by $custom_fields_table.sort ASC";
    return $this->db->query($sql);
}

}
