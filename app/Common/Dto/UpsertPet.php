<?php
namespace App\Common\Dto;


use stdClass;

class UpsertPet
{
    private string $prefix;
    public string $petId {
        get {
            return $this->petId;
        }
    }
    public string $petName {
        get {
            return $this->petName;
        }
    }
    public ?array $category {
        get {
            return $this->category;
        }
    }
    public ?array $photoUrls {
        get {
            return $this->photoUrls;
        }
    }
    public ?array $tags {
        get {
            return $this->tags;
        }
    }
    public ?string $status {
        get {
            return $this->status;
        }
    }

    public function __construct(string $prefix, array $data)
    {
        $this->prefix = $prefix;
        $this->populateVariables($data);
    }

    private function populateVariables(array $data): void
    {
        $prefix = $this->prefix;
        $this->photoUrls = array_filter(array_map(
            fn($v)=>trim($v,';'), explode(';;;', $data[$prefix."photos"])
        ));
        $tags = array_map(function ($val) {
            $start = strpos($val, '{');
            $end = strpos($val, '}');
            if((is_int($start) && is_int($end)) && $start < $end) {
                $id = substr($val, $start+1, $end-$start-1);
            }

            $name = str_replace('{'.($id ?? "").'}', '', trim($val,'#'));
            $id = $id ?? null;

            if(!empty($name) || !empty($id)) {
                $obj = new stdClass();

                if(!empty($id)) {
                    $obj->id = $id;
                }

                if(!empty($name)) {
                    $obj->name = $name;
                }
            }

            return $obj ?? null;
        }, explode('#', str_replace('##', '#', $data[$prefix."tags"])));
        $this->tags = array_filter($tags);

        $category = null;
        if(!empty($data[$prefix."category"])) {
            $category = [
                'name' => $data[$prefix."category"] ?? ''
            ];
        }

        if(!empty($data[$prefix."category-id"])) {
            $category['id'] = $data[$prefix."category-id"] ?? 0;
        }

        $this->category = $category;
        $this->status = $data[$prefix."status"] ?? null;
        $this->petId= $data[$prefix.'id'] ?? null;
        $this->petName = $data[$prefix."name"] ?? null;
    }

}
