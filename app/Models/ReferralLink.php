<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Models\User;
use App\Models\ReferralProgram;
use App\Models\ReferralRelationship;

class ReferralLink extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'referral_program_id','referral_email'];

    protected static function boot()
    {
        static::creating(function (ReferralLink $model) {
            $model->generateCode();
        });
        parent::boot();
    }

    private function generateCode()
    {
        $this->code = (string)Uuid::uuid1();
    }

    public static function getReferral($user, $program)
    {
        
        return static::firstOrCreate([
            'user_id' => $user->id,
            'referral_program_id' => $program->id
        ]);
    }

    public function getLinkAttribute()
    {
        return url($this->program->uri) . '?refer=' . $this->code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        // TODO: Check if second argument is required
        return $this->belongsTo(ReferralProgram::class, 'referral_program_id');
    }

    public function relationships()
    {
        return $this->hasMany(ReferralRelationship::class);
    }

}
