<?php

namespace App;

use Spatie\Activitylog\LogOptions;

use App\Notifications\ResetPassword;
use App\Notifications\DocumentCreate;
use App\Notifications\DocumentDelete;
use App\Notifications\DocumentDeadline;

use App\Traits\HasRolesAndPermissions;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions, LogsActivity;

    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;
    protected static $logAttributes = ['name', 'email', 'login'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login', 'settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        "settings" => "array"
    ];

    public function setting(string $name, $default = null)
    {
        if (array_key_exists($name, $this->settings)) {
            return $this->settings[$name];
        }    return $default;
    }

    public function settings(array $revisions, bool $save = true) : self
    {
        $this->settings = array_merge($this->settings, $revisions);    if ($save) {
            $this->save();
        }    return $this;
    }

    public function sendPasswordResetNotification($token) {
      $this->notify(new ResetPassword($token));
    }

    public function sendDocumentCreateNotification($document, $user) {
      $this->notify(new DocumentCreate($document, $user));
    }

    public function DocumentDeleteNotification($document, $user) {
      $this->notify(new DocumentDelete($document, $user));
    }

    public function DocumentDeadlineNotification() {
      $this->notify(new DocumentDeadline());
    }

}
