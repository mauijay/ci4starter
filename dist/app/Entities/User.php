<?php

namespace App\Entities;

use CodeIgniter\Shield\Entities\User as ShieldUser;

class User extends ShieldUser
{
    
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
     /**
     * Renders out the user's avatar at the specified size (in pixels)
     *
     * @return string
     */
    public function renderAvatar(int $size = 52)
    {
        // Determine the color for the user based on their
        // for existing users, email address since we know we'll always have that
        // Use default hash if new user or the avatar is used as a placeholder

        $idString = 'default-avatar-hash'; // Default avatar string

        if ($this->id) {
            if (setting('Users.avatarNameBasis') === 'name') {
                $idString = $this->first_name ? $this->first_name[0] . ($this->last_name[0] ?? '') : $this->username[0] . $this->username[1];
            } else {
                $idString = $this->email[0] . $this->email[1];
            }
        }

        $idString = strtoupper($idString);

        $idValue = str_split($idString);
        array_walk($idValue, static function (&$char) {
            $char = ord($char);
        });
        $idValue = implode('', $idValue);

        $colors = setting('Users.avatarPalette');

        return view('\Bonfire\Views\_avatar', [
            'user'       => $this,
            'size'       => $size,
            'fontSize'   => 20 * ($size / 52),
            'idString'   => $idString,
            'background' => $colors[$idValue % count($colors)],
        ]);
    }

    /**
     * Generates a link to the user Avatar
     */
    public function avatarLink(?int $size = null): string
    {
        /* if (isset($this->id) && empty($this->avatar)) {
            // Default from Gravatar
            if (setting('Users.useGravatar')) {
                $hash = md5(strtolower(trim($this->email)));

                return "https://www.gravatar.com/avatar/{$hash}?" . http_build_query([
                    's' => ($size ?? 60),
                    'd' => setting(
                        'Users.gravatarDefault'
                    ),
                ]);
            }
        } */

        return ! empty($this->avatar)? base_url('/uploads/avatars/' . $this->avatar): base_url("img/avatar.png");
    }

  

    public function groupsList(): string
    {
        $config = setting('AuthGroups.groups');
        $groups = $this->getGroups();

        $out = [];

        foreach ($groups as $group) {
            $out[] = $config[$group]['title'];
        }

        return implode(', ', $out);
    }


    public function adminLink(?string $postfix = null)
    {
        $url = base_url("admin"). "/admin/{$this->id}";

        if (! empty($postfix)) {
            $url .= "/{$postfix}";
        }
        return $url;
        /* return trim(site_url($url)); */
    }

    public function accountLink(?string $postfix = null)
    {
        $url = base_url("user-account"). "/update/{$this->id}";

        if (! empty($postfix)) {
            $url .= "/{$postfix}";
        }
        return $url;
        /* return trim(site_url($url)); */
    }




    

   private function gantiformat($nomorhp)
    {
        //First we trim dl
        $nomorhp = trim($nomorhp);
        //clean of unnecessary characters
        $nomorhp = strip_tags($nomorhp);
        // Remove from spaces
        $nomorhp = str_replace(" ", "", $nomorhp);
        // clean it from shapes like (022) 66677788
        $nomorhp = str_replace("(", "", $nomorhp);
        $nomorhp = str_replace(")", "", $nomorhp);
        // clear from the dot format like 0811.222.333.4
        $nomorhp = str_replace(".", "", $nomorhp);

        //checks if it contains + and 0-9 characters
        if (!preg_match('/[^+0-9]/', trim($nomorhp))) {
            // Check if the cellphone number for characters 1-3 is +62
            if (substr(trim($nomorhp), 0, 3) == '+62') {
                $nomorhp = trim($nomorhp);
            }
            // check if the cellphone number of character 1 is 0
           if (substr($nomorhp, 0, 1) == '0') {
                $nomorhp = '+62' . substr($nomorhp, 1);
            }
            if (substr($nomorhp, 0, 2) == '62') {
                $nomorhp = '+' . $nomorhp;
            }

        }
        return $nomorhp;
    }



    function linkwa()
    {
        $nomorhp = $this->gantiformat($this->attributes['whatsapp']);
        $nomorhp = trim($nomorhp, "+");
        return  'https://api.whatsapp.com/send?phone=' . $nomorhp;
    }

   
   
}
