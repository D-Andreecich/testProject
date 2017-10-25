<?php

namespace App\Http\Controllers\test;

use App\DataForSEO;
use App\DataJSONb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RestClient;
use App\Http\Controllers\RestClientException;
use Illuminate\Database\Eloquent\Collection;

//require (__DIR__ . '/../../../RestClient.php');

class TestController extends Controller
{
    private $login = 'challenger15@rankactive.info';
    private $password = 'IofghFDh35jFF33jF3F2';

    private function authGo()
    {
        try {
            //Instead of 'login' and 'password' use your credentials from https://my.dataforseo.com/login
            return new RestClient('https://api.dataforseo.com/', null, $this->login, $this->password);

        } catch (RestClientException $e) {
            echo "\n";
            print "HTTP code: {$e->getHttpCode()}\n";
            print "Error code: {$e->getCode()}\n";
            print "Message: {$e->getMessage()}\n";
            print  $e->getTraceAsString();
            echo "\n";
            exit();
        }
    }

    public function show()
    {
        return view('test.test');
    }

    public function getResult()
    {
        $result = DataForSEO::all();
        echo json_encode($result);
    }

    public function getDataGet(Request $request)
    {
        $client = $this->authGo();
        /*
        #2 - get one result by task_id
        */
        try {
            // GET /api/v1/tasks_get/$task_id
            $task_get_result = $client->get('v2/rnk_tasks_get/' . $request->task_id);

            if ($task_get_result['status'] === 'ok' && $task_get_result['results_count'] != '0') {
                $this->createRecordToDB($task_get_result['results']['organic']);
                echo 'ok  [ task_id ]';
            } else {
                echo 'error [ task_id ]';
            }

            //do something with result
        } catch (RestClientException $e) {
            echo "\n";
            print "HTTP code: {$e->getHttpCode()}\n";
            print "Error code: {$e->getCode()}\n";
            print "Message: {$e->getMessage()}\n";
            print  $e->getTraceAsString();
            echo "\n";
        }

        $client = null;
    }

    public function getDataPost(Request $request)
    {

        $client = $this->authGo();

        $post_array = array();

        $my_unq_id = mt_rand(0, 30000000);
        $post_array[$my_unq_id] = array(
            "priority" => 1,
            "site" => $request->site,
            "se_name" => $request->se_name,
            "se_language" => $request->se_language,
            "loc_name_canonical" => $request->loc_name_canonical,
            "key" => mb_convert_encoding($request->key, "UTF-8")
        );

        if (count($post_array) > 0) {
            try {
                // POST /v2/rnk_tasks_post/$data
//                 $tasks_data must by array with key 'data'
                $task_post_result = $client->post('v2/rnk_tasks_post', array('data' => $post_array));
                if ($task_post_result['status'] === 'ok') {
                    $this->createRecordToDB($task_post_result['results']);
                }

                echo $task_post_result['status'] . ' [ Test post ]';

                //do something with post results
            } catch (RestClientException $e) {
                echo "\n";
                print "HTTP code: {$e->getHttpCode()}\n";
                print "Error code: {$e->getCode()}\n";
                print "Message: {$e->getMessage()}\n";
                print  $e->getTraceAsString();
                echo "\n";
            }
        }

        $client = null;
    }

    public function createRecordToDB($task_result)
    {
        foreach ($task_result as $result) {

            $data = DataForSEO::where('task_id', $result['task_id'])->first();
            if ($data) {
                $data->post_key = $result['post_key'] ?? '';
                $data->result_datetime = $result['result_datetime'] ?? '';
                $data->result_position = $result['result_position'] ?? 0;
                $data->result_url = $result['result_url'] ?? '';
                $data->result_title = $result['result_title'] ?? '';
                $data->result_snippet_extra = $result['result_snippet_extra'] ?? '';
                $data->result_snippet = $result['result_snippet'] ?? '';
                $data->results_count = $result['results_count'] ?? 0;
                $data->result_extra = $result['result_extra'] ?? '';
                $data->result_spell = $result['result_spell'] ?? '';
                $data->result_se_check_url = $result['result_se_check_url'] ?? '';
                $data->save();
            } else {
                $data = new DataForSEO();
                $data->id = $result['post_id'] ?? 0;
                $data->post_id = $result['post_id'] ?? 0;
                $data->task_id = $result['task_id'] ?? 0;
                $data->se_id = $result['se_id'] ?? 0;
                $data->loc_id = $result['loc_id'] ?? 0;
                $data->key_id = $result['key_id'] ?? 0;
                $data->post_key = $result['post_key'] ?? '';
                $data->post_site = $result['post_site'] ?? '';
                $data->result_datetime = $result['result_datetime'] ?? '';
                $data->result_position = $result['result_position'] ?? 0;
                $data->result_url = $result['result_url'] ?? '';
                $data->result_title = $result['result_title'] ?? '';
                $data->result_snippet_extra = $result['result_snippet_extra'] ?? '';
                $data->result_snippet = $result['result_snippet'] ?? '';
                $data->results_count = $result['results_count'] ?? 0;
                $data->result_extra = $result['result_extra'] ?? '';
                $data->result_spell = $result['result_spell'] ?? '';
                $data->result_se_check_url = $result['result_se_check_url'] ?? '';
                $data->save();
            }

            //In case you save data in json

            /*$dataJson = DataJSONb::find($result['task_id']);
            if($dataJson) {
                $dataJson->data_json = json_encode($result);
                $dataJson->save();
            }else{
                $dataJson = new DataJSONb();
                $dataJson->id = $result['task_id'];
                $dataJson->data_json = json_encode($result);
                $dataJson->save();
            }*/
        }

    }

    protected function adminDrop()
    {
        DataForSEO::getQuery()->delete();
        DataJSONb::getQuery()->delete();
        return redirect()->route('testing');
    }

}
