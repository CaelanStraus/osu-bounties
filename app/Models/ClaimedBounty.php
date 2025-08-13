<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClaimedBounty extends Model
{
    use HasFactory;

    protected $fillable = ['bounty_id', 'user_id', 'contact_info', 'verified'];

    public function bounty()
    {
        return $this->belongsTo(Bounty::class, 'bounty_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}