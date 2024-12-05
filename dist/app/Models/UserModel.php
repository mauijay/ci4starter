<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;
use App\Entities\User;
use ReflectionException;

class UserModel extends ShieldUserModel {
  protected $returnType = User::class;
  protected function initialize(): void
  {
    parent::initialize();

    $this->allowedFields = [
      ...$this->allowedFields,
      'first_name',
      'last_name',
      'dob',
      'address',
      'alternative_address',
      'city',
      'state',
      'zip',
      'client_id',
      'description',
      'image',
      'phone',
      'mobile_number',
      'message_checked_at',
      'notification_checked_at',
      'job_title',
      'user_type',
      'note',
      'sticky_note',
      'enable_web_notification',
      'enable_email_notification',
      'request_account_removal',
      'avatar',
      'whatsapp',
      'instagram',
      'facebook',
      'twitter',
      'linked_in',
      'skype',
      'tiktok'
    ];
    // Add event after insert
    // $this->afterInsert[] = 'createNotificationSettings';

    // Add event after delete and restore
    // $this->afterDelete[]  = 'afterUserDelete';
    // $this->afterRestore[] = 'afterUserRestore';
  }

  /**
   * Summary of lastActiveUser
   * @param mixed $limit
   * @return array
   */
  public function lastActiveUser($limit = 6)
  {
    $users = $this
      ->where('last_active !=', null)
      ->OrderBy('last_active', 'desc')
      ->limit($limit)
      ->findAll();
    return $users;
  }

  /**
   * Only return users that are active.
   */
  public function active(): self
  {
    return $this->where('active', 1);
  }

  /**
   * Only return users that have been active on the site within
   * the last 24 hours.
   *
   * NOTE: This requires that Config\Auth::recordActiveDate is set to true.
   */
  public function activeToday(): self
  {
    return $this->where('last_active >=', Time::now()->subHours(24)->toDateTimeString());
  }

  /**
   * Create default notification settings for user.
   *
   * @throws ReflectionException
   */
  protected function createNotificationSettings(array $eventData): void
  {
    if ($eventData['result']) {
      model(NotificationSettingModel::class)->insert(['user_id' => $eventData['id']]);
    }
  }
}
