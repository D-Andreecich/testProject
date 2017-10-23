<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class DataForSEO extends Model
{
    protected $table = 'dataForSEO';

    protected $fillable = [
        'post_id', 'task_id', 'se_id', 'loc_id', 'key_id', 'post_key', 'post_site', 'result_datetime',
        'result_position', 'result_url', 'result_title', 'result_snippet_extra', 'result_snippet', 'results_count', 'result_extra',
        'result_spell', 'result_se_check_url', ];

    public $timestamps = false;
}
