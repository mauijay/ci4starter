<?php namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\PollingModel;

class Poll extends Entity
{
	protected $dates = [
		'created_at',
		'updated_at',
    'deleted_at',
	];	

	// search for our question
	public function get($id)
	{
    $polls = new PollingModel();		
		$similar = $polls->where('q_id', $id)->first();

		return $similar;
	}
}
