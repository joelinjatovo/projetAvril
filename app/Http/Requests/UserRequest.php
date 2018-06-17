<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
    
    static public function memberPersonRules()
    {
        $rules = self::loginRules();
        $rules = array_merge($rules, self::personRules());
        $rules = array_merge($rules, self::locationRules());
        return $rules;
    }
    
    static public function memberOrgaRules()
    {
        $rules = self::loginRules();
        $rules = array_merge($rules, self::orgaRules());
        $rules = array_merge($rules, self::locationRules());
        return $rules;
    }
    
    static public function aplRules()
    {
        $rules = self::loginRules();
        $rules = array_merge($rules, self::orgaRules());
        $rules = array_merge($rules, self::locationRules());
        $rules = array_merge($rules, self::contactRules());
        $rules = array_merge($rules, self::bankRules());
        $rules['orga_operation_range'] = 'required|max:100';
        return $rules;
    }
    
    static public function afaRules()
    {
        $rules = self::loginRules();
        $rules = array_merge($rules, self::orgaRules());
        $rules = array_merge($rules, self::locationRules());
        $rules = array_merge($rules, self::contactRules());
        $rules = array_merge($rules, self::crmRules());
        $rules['orga_operation_state'] = 'required|max:100';
        $rules['orga_operation_range'] = 'required|max:100';
        return $rules;
    }
    
    static public function sellerRules()
    {
        $rules = self::loginRules();
        $rules = array_merge($rules, self::orgaRules());
        $rules = array_merge($rules, self::locationRules());
        $rules = array_merge($rules, self::contactRules());
        $rules = array_merge($rules, self::crmRules());
        $rules['orga_operation_state'] = 'required|max:100';
        $rules['orga_operation_range'] = 'required|max:100';
        return $rules;
    }
    
    static private function loginRules()
    {
        return [
            'name'     => 'required|unique:users,name|max:100',
            'email'    => 'required|unique:users,email|max:100',
            'language' => 'required|max:100',
            'image'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    
    static private function personRules()
    {
        return [
            'first_name' => 'required|max:100',
            'last_name'  => 'required|max:100',

            'prefixPhone' => 'required|max:100',
            'phone'       => 'required|max:100',
        ];
    }
    
    static private function orgaRules()
    {
        return [
            'orga_name'         => 'required|max:100',
            'orga_presentation' => 'required|max:100',
            'orga_email'        => 'required|email|max:100',
            'orga_phone'        => 'required|max:100',
            'orga_website'      => 'required|url|max:100',
        ];
    }
    
    static private function operationRules()
    {
        return [
            'orga_operation_state' => 'required|max:100',
            'orga_operation_range' => 'required|max:100',
        ];
    }
    
    static private function locationRules()
    {
        return [
            'country'      => 'nullable|max:100',
            'area_level_1' => 'required|max:100',
            'area_level_2' => 'required|max:100',
            'locality'     => 'required|max:100',
            'route'        => 'nullable|max:100',
            'postalCode'   => 'nullable|max:100',
        ];
    }
    
    
    static private function contactRules()
    {
        return [
            'contact_name'  => 'required|max:100',
            'contact_email' => 'required|max:100',
            'contact_phone' => 'required|max:100',
        ];
    }
    
    static private function bankRules()
    {
        return [
            'bank_iban'   => 'required|max:100',
            'bank_bic'   => 'required|max:100',
            'paypal_email'  => 'required|max:100',
        ];
    }
    
    static private function crmRules()
    {
        return [
            'crm_name'   => 'required|max:100',
            'crm_email'  => 'required|max:100',
        ];
    }
}
