<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','kana','tel','email','postcode',
        'address', 'birthday','gender', 'memo'];

    //モデルクラスにスコープ関数を作成し検索機能を搭載
    //関数名の前にかならずscopeをつけてコントローラー側ではscopeを取り除いて関数を呼び出す
    //inputの初期値はnullに指定し、入力値がない場合にはリターンしない
    public function scopeSearchCustomers($query,$input = null){
        if(!empty($input)){
            //orWhereはSQLのorを表す
            if(Customer::where("kana","like",$input . "%")
            ->orWhere("tel","like",$input . "%")->exists())
            {
             return $query->where("kana","like", $input . "%")
             ->orWhere("tel","like",$input . "%");   
            }
        }
    }
}
