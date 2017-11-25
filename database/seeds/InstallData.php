<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Country;
use App\Models\AttributeGroup;

class InstallData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Users and roles
        $roleID = Role::insertGetId(['name'=>'Administrator', 'slug'=> 'administrator']);
        $userID = User::insertGetId([
            'username'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('123123123'),
            'is_admin'=>1,
            'is_buyer' => 1,
            'is_seller' => 1,
            'status' => 1,
            'first_name' => 'Ho',
            'last_name' => 'Huu Hien',
            'address1' => 'Address 1',
            'country' => 'Viet Nam',
            'postal_code' => '555000',
            'region' => 'Asia',
            'confirmed' => 1,
            'is_notify' => 1
        ]);
        RoleUser::create(['role_id' => $roleID, 'user_id' => $userID]);

        $roleID = Role::insertGetId(['name'=>'Seller', 'slug'=> 'seller']);
        $userID = User::insertGetId([
            'username'=>'seller',
            'email'=>'seller@gmail.com',
            'password'=>bcrypt('123123123'),
            'is_admin'=> 0,
            'is_buyer' => 0,
            'is_seller' => 1,
            'status' => 1,
            'first_name' => 'Ho',
            'last_name' => 'Huu Hien',
            'address1' => 'Address 1',
            'country' => 'Viet Nam',
            'postal_code' => '555000',
            'region' => 'Asia',
            'confirmed' => 1,
            'is_notify' => 1
        ]);
        RoleUser::create(['role_id' => $roleID, 'user_id' => $userID]);

        $roleID = Role::insertGetId(['name'=>'Buyer', 'slug'=> 'buyer']);
        $userID = User::insertGetId([
            'username'=>'buyer',
            'email'=>'buyer@gmail.com',
            'password'=>bcrypt('123123123'),
            'is_admin'=> 0,
            'is_buyer' => 1,
            'is_seller' => 0,
            'status' => 1,
            'first_name' => 'Ho',
            'last_name' => 'Huu Hien',
            'address1' => 'Address 1',
            'country' => 'Viet Nam',
            'postal_code' => '555000',
            'region' => 'Asia',
            'confirmed' => 1,
            'is_notify' => 1
        ]);
        RoleUser::create(['role_id' => $roleID, 'user_id' => $userID]);

        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        $i = 0;
        foreach( $countries as $country){
            Country::create([
                'code' => $i,
                'name' => $country
            ]);
            $i++;
        }
        AttributeGroup::create(['seller_id' => 1, 'name' => 'Colorbox', 'parent' => 0, 'type' => 'color']);
        AttributeGroup::create(['seller_id' => 1, 'name' => 'Select Dropdown', 'parent' => 0, 'type' => 'select']);
        AttributeGroup::create(['seller_id' => 1, 'name' => 'Text Box', 'parent' => 0, 'type' => 'text']);
        AttributeGroup::create(['seller_id' => 1, 'name' => 'Check Box', 'parent' => 0, 'type' => 'checkbox']);
        AttributeGroup::create(['seller_id' => 1, 'name' => 'Radio Box', 'parent' => 0, 'type' => 'radio']);

    }
}
