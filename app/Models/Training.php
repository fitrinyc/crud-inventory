<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Training extends Model {
    protected $guarded = [];
    public function category() { return $this->belongsTo(TrainingCategory::class, 'training_category_id'); }
    public function participants() { return $this->hasMany(TrainingParticipant::class); }
}