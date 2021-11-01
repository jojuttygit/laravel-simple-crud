<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'company_id';

    /**
     * Get the employess for the company.
    */
    public function employees()
    {
        return $this->hasMany('Company', 'company_id', 'company_id');
    }
}