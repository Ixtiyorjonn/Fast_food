<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function userForAdmin(Request $request)
    {
        $region_id = request('region_id', null);
        $phone_number = request('phone_number', null);
        $username = request('username', null);
        $district_id = request('district_id', null);
        $dateFromRequest = request('date_from', date('Y-m-d'));
        $dateToRequest = request('date_to', date('Y-m-d'));
        $dateFrom = Carbon::createFromFormat('Y-m-d', $dateFromRequest)->startOfCentury();
        $dateTo = Carbon::createFromFormat('Y-m-d', $dateToRequest)->endOfDay();
        $role_id = request('role_id', null);
        $id = request('id', null);

        // $user = auth()->user();
        $user = User::where('id', isset($id) ? "=" : "!=", $id)
            ->where('phone_number', isset($phone_number) ? "=" : "!=", $phone_number)
            ->where('region_id', isset($region_id) ? "=" : "!=", $region_id)
            ->where('username', isset($username) ? "=" : "!=", $username)
            ->where('district_id', isset($district_id) ? "=" : "!=", $district_id)
            ->where('role_id', isset($role_id) ? "=" : "!=", $role_id)
            ->where('active', true)
            ->whereBetween('created_at', [$dateFrom, $dateTo])
            ->select(
                'phone_number',
                'username',
                'region_id',
                'district_id',
                'adress',
                'created_at'
            )
            ->get();

            if (count($user)== 0) {
                return response()->json([
                    "message" => "bunday ma'lumot mavjud emas"
                ]);
            }else {
                return response()->json([
                    "message" => $user
                ]);
            }
    }

    public function orderForAdmin()
    {
        $user_id = request('user_id', null);
        $id = request('id', null);
        $sum = request('sum', null);
        $status = request('status', null);
        $order_type = request('order_type', null);
        $payed = request('payed', null);
        $pay_type_id = request('pay_type_id', null);
        $dateFromRequest = request('date_from', date('Y-m-d'));
        $dateToRequest = request('date_to', date('Y-m-d'));
        $dateFrom = Carbon::createFromFormat('Y-m-d', $dateFromRequest)->startOfCentury();
        $dateTo = Carbon::createFromFormat('Y-m-d', $dateToRequest)->endOfDay();

        $order = Order::where('user_id', isset($user_id) ? "=" : "!=", $user_id)
            ->where('sum', isset($sum) ? "=" : "!=",  $sum)
            ->where('id', isset($id) ? "=" : "!=",  $id)
            ->where('status', isset($status) ? "=" : "!=",  $status)
            ->where('order_type', isset($order_type) ? "=" : "!=",  $order_type)
            ->where('payed', isset($payed) ? "=" : "!=",  $payed)
            ->where('pay_type_id', isset($pay_type_id) ? "=" : "!=",  $pay_type_id)
            ->with(["pay_type"])
            ->whereBetween('created_at', [$dateFrom, $dateTo])->get();

            if (!count($order)) {
                return response()->json([
                    "message" => "bunday ma'lumot mavjud emas"
                ]);
            }else {
                return response()->json([
                    "message" => $order
                ]);
            }
    }


    public function productForAdmin()
    {

        $name = request('name', null);
        $id = request('id', null);
        $price = request('price', null);
        $description = request('description', null);
        $on_discount = request('on_discount', null);
        $category_id = request('category_id', null);
        $photo_url = request('photo_url', null);
        $new = request('new', null);
        $duration_time = request('duration_time', null);

        $product = Product::where('name', isset($name) ? "=" : "!=", $name)
            ->where('price', isset($price) ? "=" : "!=", $price)
            ->where('id', isset($id) ? "=" : "!=", $id)
            ->where('description', isset($description) ? "=" : "!=", $description)
            ->where('on_discount', isset($on_discount) ? "=" : "!=", $on_discount)
            ->where('category_id', isset($category_id) ? "=" : "!=", $category_id)
            ->where('photo_url', isset($photo_url) ? "=" : "!=", $photo_url)
            ->where('new', isset($new) ? "=" : "!=", $new)
            ->where('duration_time', isset($duration_time) ? "=" : "!=", $duration_time)
            ->where('price', isset($price) ? "=" : "!=", $price)->get();

            if (!count($product)) {
                return response()->json([
                    "message" => "bunday ma'lumot mavjud emas"
                ]);
            }else {
                return response()->json([
                    "message" => $product
                ]);
            }
    }
}
