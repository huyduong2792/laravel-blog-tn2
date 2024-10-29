<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleRequest extends Model
{
    use HasFactory;

    const STATUS_PENDING = 'pending';

    const STATUS_APPROVED = 'approved';
    
    const STATUS_REJECTED = 'rejected';

    protected $fillable = ['user_id', 'role_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
