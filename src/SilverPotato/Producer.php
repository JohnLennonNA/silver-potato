<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 22/02/18
 * Time: 22:31
 */

namespace SilverPotato;

class Producer
{
    private $client;

    public function __construct($eventClient)
    {
        $this->client = $eventClient;
        return $this;
    }

    public function send($streamName, $event, $partitionKey){
        try{
            $parameter = [
                'StreamName' => $streamName,
                'Data' => $event,
                'PartitionKey' => $partitionKey
            ];

            return $this->client->putRecord($parameter);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function sendMutiple($streamName, $events){
        try{
            $parameter = [
                'StreamName' => $streamName,
                'Records' => []
            ];

            foreach ($events as $event) {
                $parameter['Records'][] = $event;
            }

            return $this->client->putRecords($parameter);
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

}