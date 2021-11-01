<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'employee_id';

    /**
     * Get the company that owns the employee.
     */
    public function company()
    {
        return $this->belongsTo('Company', 'company_id', 'company_id');
    }
}
