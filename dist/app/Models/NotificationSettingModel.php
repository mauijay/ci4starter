<?php

namespace App\Models;

use App\Entities\NotificationSetting;
use CodeIgniter\Model;

class NotificationSettingModel extends Model
{
    protected $table            = 'notification_settings';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = false;
    protected $returnType       = NotificationSetting::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'email_thread', 'email_post', 'email_post_reply', 'moderation_daily_summary'];

    // Dates
    protected $useTimestamps = true;

    /**
     * Get settings with active email thread notifications.
     */
    public function withThreadNotification()
    {
        $this->where('email_thread', 1);

        return $this;
    }

    /**
     * Get settings with active email post notifications.
     */
    public function withPostNotification()
    {
        $this->groupStart()->where('email_post', 1)->orWhere('email_post_reply', 1)->groupEnd();

        return $this;
    }

    /**
     * Get settings with any active email notification.
     */
    public function withAnyNotification()
    {
        $this->groupStart()->where('email_thread', 1)->orWhere('email_post', 1)->orWhere('email_post_reply', 1)->groupEnd();

        return $this;
    }

    function notify_to_terms()
  {
    return array(
      "team_members", "team", "project_members", "client_primary_contact", "client_all_contacts", "task_assignee", "task_collaborators", "comment_creator", "cusomer_feedback_creator", "leave_applicant", "ticket_creator", "ticket_assignee", "estimate_request_assignee", "recipient", "mentioned_members", "owner", "client_assigned_contacts", "post_creator", "order_creator_contact", "estimate_creator"
    );
  }

  //public function getFeaturedNews($catId = false)
  public function get_details($options = array())
  {
    $notification_settings_table = $this->db->prefixTable('notification_settings');
    $users_table = $this->db->prefixTable('users');
    $team_table = $this->db->prefixTable('team');
    //$id = $this->_get_clean_value($options, "id");
    //$category = $this->_get_clean_value($options, "category");    
    /*
    if ($id) {
      return $this
      ->select("notification_settings.*, categories.id as catId, categories.cat_name, users.id as userId, users.avatar, users.username")
      //->where('notification_settings.id', $id)
      ->where('notification_settings.category', $category)
      //->join('team', 'news.id_category=team.id', 'left')
      //->join('users', 'news.id_author=users.id', 'left')

      ->where(['notification_settings.deleted' => 0])
      ->orderBy('notification_settings.sort', 'ASC');
    }
    */
    //return $this->getResult();   
    //->where(['notification_settings.deleted' => 0])
    //->orderBy('notification_settings.sort', 'ASC');
    
    $where = "";
    $id = $this->_get_clean_value($options, "id");
    if ($id) {
        $where = " AND $notification_settings_table.id=$id";
    }

    $category = $this->_get_clean_value($options, "category");
    if ($category) {
        $where .= " AND $notification_settings_table.category='$category'";
    }

    $sql = "SELECT $notification_settings_table.*, 
            (SELECT GROUP_CONCAT(' ',$users_table.first_name,' ',$users_table.last_name) FROM $users_table WHERE $users_table.deleted=0 AND FIND_IN_SET($users_table.id, $notification_settings_table.notify_to_team_members)) as team_members_list,
            (SELECT GROUP_CONCAT(' ',$team_table.title) FROM $team_table WHERE FIND_IN_SET($team_table.id, $notification_settings_table.notify_to_team)) as team_list
    FROM $notification_settings_table
    WHERE $notification_settings_table.deleted=0 $where 
    ORDER BY $notification_settings_table.sort ASC";  
    
    return $this->db->query($sql);  
  }

  function get_details1($options = array())
  {
    $notification_settings_table = $this->db->prefixTable('notification_settings');
    
    $users_table = $this->db->prefixTable('users');
    $team_table = $this->db->prefixTable('team');

    $where = "";
    $id = $this->_get_clean_value($options, "id");
    if ($id) {
        $where = " AND $notification_settings_table.id=$id";
    }

    $category = $this->_get_clean_value($options, "category");
    if ($category) {
        $where .= " AND $notification_settings_table.category='$category'";
    }

    $sql = "SELECT $notification_settings_table.*, 
            (SELECT GROUP_CONCAT(' ',$users_table.first_name,' ',$users_table.last_name) FROM $users_table WHERE $users_table.deleted=0 AND FIND_IN_SET($users_table.id, $notification_settings_table.notify_to_team_members)) as team_members_list,
            (SELECT GROUP_CONCAT(' ',$team_table.title) FROM $team_table WHERE FIND_IN_SET($team_table.id, $notification_settings_table.notify_to_team)) as team_list
    FROM $notification_settings_table
    WHERE $notification_settings_table.deleted=0 $where 
    ORDER BY $notification_settings_table.sort ASC";

    return $this->db->query($sql);
  }

  function get_notify_to_users_of_event($event = "")
  {
    if ($event) {
        $notification_settings_table = $this->db->prefixTable('notification_settings');
        $users_table = $this->db->prefixTable('users');
        $team_table = $this->db->prefixTable('team');

        $notification_settings = $this->db->query("SELECT * FROM $notification_settings_table WHERE  $notification_settings_table.event='$event' AND ($notification_settings_table.enable_email OR $notification_settings_table.enable_web)")->getRow();
        if (!$notification_settings) {
            return false; //not notification settings found
        }

        $sql = "SELECT $users_table.id
        FROM $users_table
        WHERE $users_table.deleted=0 AND (FIND_IN_SET($users_table.id, '$notification_settings->notify_to_team_members') OR FIND_IN_SET($users_table.id, (SELECT GROUP_CONCAT($team_table.members) AS team_users FROM $team_table WHERE $team_table.deleted=0 AND FIND_IN_SET($team_table.id, '$notification_settings->notify_to_team'))))";

        $result = new \stdClass();
        $result->result = $this->db->query($sql)->getResult();
        $result->notify_to_terms = $notification_settings->notify_to_terms;

        return $result;
    }
  }

  protected function _get_clean_value($options, $key)
  {
    $value = get_array_value($options, $key);
    if ($value) {
        return $this->db->escapeString($value);
    } else {
        return $value; //false, 0, null
    }
  }
}
