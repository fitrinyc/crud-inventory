<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class TrainingParticipant extends Model {
    protected $guarded = [];
    public function training() { return $this->belongsTo(Training::class); }
    public function employee() { return $this->belongsTo(Employee::class); }
    public function certificate() { return $this->hasOne(Certificate::class); }
}