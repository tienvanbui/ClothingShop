<?php 
namespace App\Components;


class RecusiveMenu{
    private $data;
    private $htmlResult = '';

    public function __construct($data)
    {
        $this->data = $data;
    }
    public function menuRecusive($parentID,$id = 0,$text = ''){
       foreach ($this->data as $item){
           if($item['parent_id'] == $id){
               if(!empty($parentID) && $parentID==$item['id']){
                   $this->htmlResult .="<option selected value='".$item['id']."'>".$text.$item['name']."</option>";
               }
                $this->htmlResult .="<option value='".$item['id']."'>".$text.$item['name']."</option>";
                $this->menuRecusive($parentID,$item['id'],$text.'-');
           }
       }
       return $this->htmlResult;
    }
    
}
?>