<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Certificate extends Model {
    protected $guarded = [];
    public function participant() { return $this->belongsTo(TrainingParticipant::class, 'training_participant_id'); }
}