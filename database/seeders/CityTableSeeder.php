<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pakistan = Country::where('name', 'Pakistan')->first();
        $australia = Country::where('name', 'Australia')->first();
        
        City::insert([
            ['name' => 'Karachi', 'country_id' => $pakistan->id],
            ['name' => 'Lahore', 'country_id' => $pakistan->id],
            ['name' => 'Faisalabad', 'country_id' => $pakistan->id],
            ['name' => 'Rawalpindi', 'country_id' => $pakistan->id],
            ['name' => 'Multan', 'country_id' => $pakistan->id],
            ['name' => 'Hyderabad', 'country_id' => $pakistan->id],
            ['name' => 'Gujranwala', 'country_id' => $pakistan->id],
            ['name' => 'Peshawar', 'country_id' => $pakistan->id],
            ['name' => 'Quetta', 'country_id' => $pakistan->id],
            ['name' => 'Islamabad', 'country_id' => $pakistan->id],
            ['name' => 'Sargodha', 'country_id' => $pakistan->id],
            ['name' => 'Sialkot', 'country_id' => $pakistan->id],
            ['name' => 'Bahawalpur', 'country_id' => $pakistan->id],
            ['name' => 'Sukkur', 'country_id' => $pakistan->id],
            ['name' => 'Jhang', 'country_id' => $pakistan->id],
            ['name' => 'Sheikhupura', 'country_id' => $pakistan->id],
            ['name' => 'Larkana', 'country_id' => $pakistan->id],
            ['name' => 'Gujrat', 'country_id' => $pakistan->id],
            ['name' => 'Mardan', 'country_id' => $pakistan->id],
            ['name' => 'Kasur', 'country_id' => $pakistan->id],
            ['name' => 'Rahim Yar Khan', 'country_id' => $pakistan->id],
            ['name' => 'Sahiwal', 'country_id' => $pakistan->id],
            ['name' => 'Okara', 'country_id' => $pakistan->id],
            ['name' => 'Wah', 'country_id' => $pakistan->id],
            ['name' => 'Dera Ghazi Khan', 'country_id' => $pakistan->id],
            ['name' => 'Mirpur Khas', 'country_id' => $pakistan->id],
            ['name' => 'Nawabshah', 'country_id' => $pakistan->id],
            ['name' => 'Mingora', 'country_id' => $pakistan->id],
            ['name' => 'Chiniot', 'country_id' => $pakistan->id],
            ['name' => 'Kamoke', 'country_id' => $pakistan->id],
            ['name' => 'Mandi Burewala', 'country_id' => $pakistan->id],
            ['name' => 'Jhelum', 'country_id' => $pakistan->id],
            ['name' => 'Sadiqabad', 'country_id' => $pakistan->id],
            ['name' => 'Jacobabad', 'country_id' => $pakistan->id],
            ['name' => 'Shikarpur', 'country_id' => $pakistan->id],
            ['name' => 'Khanewal', 'country_id' => $pakistan->id],
            ['name' => 'Hafizabad', 'country_id' => $pakistan->id],
            ['name' => 'Kohat', 'country_id' => $pakistan->id],
            ['name' => 'Muzaffargarh', 'country_id' => $pakistan->id],
            ['name' => 'Khanpur', 'country_id' => $pakistan->id],
            ['name' => 'Gojra', 'country_id' => $pakistan->id],
            ['name' => 'Bahawalnagar', 'country_id' => $pakistan->id],
            ['name' => 'Muridke', 'country_id' => $pakistan->id],
            ['name' => 'Pak Pattan', 'country_id' => $pakistan->id],
            ['name' => 'Abottabad', 'country_id' => $pakistan->id],
            ['name' => 'Tando Adam', 'country_id' => $pakistan->id],
            ['name' => 'Jaranwala', 'country_id' => $pakistan->id],
            ['name' => 'Khairpur', 'country_id' => $pakistan->id],
            ['name' => 'Chishtian Mandi', 'country_id' => $pakistan->id],
            ['name' => 'Daska', 'country_id' => $pakistan->id],
            ['name' => 'Dadu', 'country_id' => $pakistan->id],
            ['name' => 'Mandi Bahauddin', 'country_id' => $pakistan->id],
            ['name' => 'Ahmadpur East', 'country_id' => $pakistan->id],
            ['name' => 'Kamalia', 'country_id' => $pakistan->id],
            ['name' => 'Khuzdar', 'country_id' => $pakistan->id],
            ['name' => 'Vihari', 'country_id' => $pakistan->id],
            ['name' => 'Dera Ismail Khan', 'country_id' => $pakistan->id],
            ['name' => 'Wazirabad', 'country_id' => $pakistan->id],
            ['name' => 'Nowshera', 'country_id' => $pakistan->id],
            ['name' => 'Melbourne', 'country_id' => $australia->id],
            ['name' => 'Sydney', 'country_id' => $australia->id],
            ['name' => 'Brisbane', 'country_id' => $australia->id],
            ['name' => 'Perth', 'country_id' => $australia->id],
            ['name' => 'Adelaide', 'country_id' => $australia->id],
            ['name' => 'Gold Coast', 'country_id' => $australia->id],
            ['name' => 'Cranbourne', 'country_id' => $australia->id],
            ['name' => 'Canberra', 'country_id' => $australia->id],
            ['name' => 'Central Coast', 'country_id' => $australia->id],
            ['name' => 'Wollongong', 'country_id' => $australia->id],
            ['name' => 'Ipswich', 'country_id' => $australia->id],
            ['name' => 'Hobart', 'country_id' => $australia->id],
            ['name' => 'Geelong', 'country_id' => $australia->id],
            ['name' => 'Townsville', 'country_id' => $australia->id],
            ['name' => 'Newcastle', 'country_id' => $australia->id],
            ['name' => 'Cairns', 'country_id' => $australia->id],
            ['name' => 'Darwin', 'country_id' => $australia->id],
            ['name' => 'Ballarat', 'country_id' => $australia->id],
            ['name' => 'Toowoomba', 'country_id' => $australia->id],
            ['name' => 'Bendigo', 'country_id' => $australia->id],
            ['name' => 'Mandurah', 'country_id' => $australia->id],
            ['name' => 'Launceston', 'country_id' => $australia->id],
            ['name' => 'Mackay', 'country_id' => $australia->id],
            ['name' => 'Hervey Bay', 'country_id' => $australia->id],
            ['name' => 'Buderim', 'country_id' => $australia->id],
            ['name' => 'Wagga Wagga', 'country_id' => $australia->id],
            ['name' => 'Pakenham', 'country_id' => $australia->id],
            ['name' => 'Port Macquarie', 'country_id' => $australia->id],
            ['name' => 'Caloundra', 'country_id' => $australia->id],
            ['name' => 'Frankston', 'country_id' => $australia->id],
            ['name' => 'Sunbury', 'country_id' => $australia->id],
            ['name' => 'Gladstone', 'country_id' => $australia->id],
            ['name' => 'Bathurst', 'country_id' => $australia->id],
            ['name' => 'Palmerston', 'country_id' => $australia->id],
            ['name' => 'Southport', 'country_id' => $australia->id],
            ['name' => 'Dandenong', 'country_id' => $australia->id],
            ['name' => 'Warrnambool', 'country_id' => $australia->id],
            ['name' => 'Quakers Hill', 'country_id' => $australia->id],
            ['name' => 'Mount Gambier', 'country_id' => $australia->id],
            ['name' => 'Traralgon', 'country_id' => $australia->id],
            ['name' => 'Whyalla', 'country_id' => $australia->id],
            ['name' => 'Armidale', 'country_id' => $australia->id],
            ['name' => 'Burnie', 'country_id' => $australia->id],
            ['name' => 'Griffith', 'country_id' => $australia->id],
            ['name' => 'Mount Eliza', 'country_id' => $australia->id],
            ['name' => 'Maroochydore', 'country_id' => $australia->id],
            ['name' => 'Taree', 'country_id' => $australia->id],
            ['name' => 'Banora Point', 'country_id' => $australia->id],
            ['name' => 'Lara', 'country_id' => $australia->id],
            ['name' => 'Cessnock', 'country_id' => $australia->id],
            ['name' => 'Horsham', 'country_id' => $australia->id],
            ['name' => 'Murray Bridge', 'country_id' => $australia->id],
            ['name' => 'Wallan', 'country_id' => $australia->id],
            ['name' => 'Australind', 'country_id' => $australia->id],
            ['name' => 'Ormeau', 'country_id' => $australia->id],
            ['name' => 'Barwon Heads', 'country_id' => $australia->id],
            ['name' => 'Mount Barker', 'country_id' => $australia->id],
            ['name' => 'Morwell', 'country_id' => $australia->id],
            ['name' => 'Forster', 'country_id' => $australia->id],
            ['name' => 'Penrith', 'country_id' => $australia->id],
            ['name' => 'Goonellabah', 'country_id' => $australia->id],
            ['name' => 'Leopold', 'country_id' => $australia->id],
            ['name' => 'Campbelltown', 'country_id' => $australia->id],
            ['name' => 'Rutherford', 'country_id' => $australia->id],
            ['name' => 'Nambour', 'country_id' => $australia->id],
            ['name' => 'Corinda', 'country_id' => $australia->id],
            ['name' => 'Muswellbrook', 'country_id' => $australia->id],
            ['name' => 'Kingston', 'country_id' => $australia->id],
            ['name' => 'Grafton', 'country_id' => $australia->id],
            ['name' => 'Bowral', 'country_id' => $australia->id],
            ['name' => 'Kingaroy', 'country_id' => $australia->id],
            ['name' => 'Casino', 'country_id' => $australia->id],
            ['name' => 'Swan Hill', 'country_id' => $australia->id],
            ['name' => 'Parkes', 'country_id' => $australia->id],
            ['name' => 'Mudgee', 'country_id' => $australia->id],
            ['name' => 'Mount Evelyn', 'country_id' => $australia->id],
            ['name' => 'Inverell', 'country_id' => $australia->id],
            ['name' => 'Andergrove', 'country_id' => $australia->id],
            ['name' => 'Nowra', 'country_id' => $australia->id],
            ['name' => 'Flemington', 'country_id' => $australia->id],
            ['name' => 'Colac', 'country_id' => $australia->id],
            ['name' => 'Bargara', 'country_id' => $australia->id],
            ['name' => 'Ballina', 'country_id' => $australia->id],
            ['name' => 'Mareeba', 'country_id' => $australia->id],
            ['name' => 'Moss Vale', 'country_id' => $australia->id],
            ['name' => 'Springwood', 'country_id' => $australia->id],
            ['name' => 'Rye', 'country_id' => $australia->id],
            ['name' => 'Cowra', 'country_id' => $australia->id],
            ['name' => 'Beenleigh', 'country_id' => $australia->id],
            ['name' => 'Tweed Heads', 'country_id' => $australia->id],
            ['name' => 'Emu Plains', 'country_id' => $australia->id],
            ['name' => 'Charters Towers', 'country_id' => $australia->id],
            ['name' => 'Katoomba', 'country_id' => $australia->id],
            ['name' => 'Mooroopna', 'country_id' => $australia->id],
            ['name' => 'Maryborough', 'country_id' => $australia->id],
            ['name' => 'Young', 'country_id' => $australia->id],
            ['name' => 'Narre Warren North', 'country_id' => $australia->id],
            ['name' => 'Clifton Springs', 'country_id' => $australia->id],
            ['name' => 'Castlemaine', 'country_id' => $australia->id],
            ['name' => 'Kingscliff', 'country_id' => $australia->id],
            ['name' => 'Fremantle', 'country_id' => $australia->id],
            ['name' => 'Leeton', 'country_id' => $australia->id],
            ['name' => 'Blaxland', 'country_id' => $australia->id],
            ['name' => 'Kyabram', 'country_id' => $australia->id],
            ['name' => 'Sanctuary Point', 'country_id' => $australia->id],
            ['name' => 'Moama', 'country_id' => $australia->id],
            ['name' => 'Merrimac', 'country_id' => $australia->id],
            ['name' => 'Moree', 'country_id' => $australia->id],
            ['name' => 'Murwillumbah', 'country_id' => $australia->id],
            ['name' => 'Urraween', 'country_id' => $australia->id],
            ['name' => 'Bongaree', 'country_id' => $australia->id],
            ['name' => 'Bomaderry', 'country_id' => $australia->id],
            ['name' => 'Ulverstone', 'country_id' => $australia->id],
            ['name' => 'Dromana', 'country_id' => $australia->id],
            ['name' => 'Helensburgh', 'country_id' => $australia->id],
            ['name' => 'Seymour', 'country_id' => $australia->id],
            ['name' => 'Port Augusta', 'country_id' => $australia->id],
            ['name' => 'Burpengary', 'country_id' => $australia->id],
            ['name' => 'Waterford', 'country_id' => $australia->id],
            ['name' => 'Deniliquin', 'country_id' => $australia->id],
            ['name' => 'Strathalbyn', 'country_id' => $australia->id],
            ['name' => 'Lennox Head', 'country_id' => $australia->id],
            ['name' => 'Nambucca Heads', 'country_id' => $australia->id],
            ['name' => 'Wauchope', 'country_id' => $australia->id],
            ['name' => 'Tumut', 'country_id' => $australia->id],
            ['name' => 'Nuriootpa', 'country_id' => $australia->id],
            ['name' => 'Tuncurry', 'country_id' => $australia->id],
            ['name' => 'Yamba', 'country_id' => $australia->id],
            ['name' => 'Lakes Entrance', 'country_id' => $australia->id],
            ['name' => 'Kurri Kurri', 'country_id' => $australia->id],
            ['name' => 'North Mackay', 'country_id' => $australia->id],
            ['name' => 'Yass', 'country_id' => $australia->id],
            ['name' => 'Mittagong', 'country_id' => $australia->id],
            ['name' => 'Cootamundra', 'country_id' => $australia->id],
            ['name' => 'Cannonvale', 'country_id' => $australia->id],
            ['name' => 'Point Vernon', 'country_id' => $australia->id],
            ['name' => 'Palmwoods', 'country_id' => $australia->id],
            ['name' => 'Leongatha', 'country_id' => $australia->id],
            ['name' => 'Stawell', 'country_id' => $australia->id],
            ['name' => 'Narrabri', 'country_id' => $australia->id],
            ['name' => 'Whittlesea', 'country_id' => $australia->id],
            ['name' => 'Corowa', 'country_id' => $australia->id],
            ['name' => 'Inverloch', 'country_id' => $australia->id],
            ['name' => 'New Norfolk', 'country_id' => $australia->id],
            ['name' => 'Richmond', 'country_id' => $australia->id],
            ['name' => 'Wynyard', 'country_id' => $australia->id],
            ['name' => 'Woolgoolga', 'country_id' => $australia->id],
            ['name' => 'Glen Innes', 'country_id' => $australia->id],
            ['name' => 'Alstonville', 'country_id' => $australia->id],
            ['name' => 'Worragee', 'country_id' => $australia->id],
            ['name' => 'Glenbrook', 'country_id' => $australia->id],
            ['name' => 'Nairne', 'country_id' => $australia->id],
            ['name' => 'Tahmoor', 'country_id' => $australia->id],
            ['name' => 'Scone', 'country_id' => $australia->id],
            ['name' => 'Kiama Downs', 'country_id' => $australia->id],
            ['name' => 'Hazelbrook', 'country_id' => $australia->id],
            ['name' => 'Lithgow', 'country_id' => $australia->id],
            ['name' => 'Encounter Bay', 'country_id' => $australia->id],
            ['name' => 'Boulder', 'country_id' => $australia->id],
            ['name' => 'Salamander Bay', 'country_id' => $australia->id],
            ['name' => 'Albury', 'country_id' => $australia->id],
            ['name' => 'Bucasia', 'country_id' => $australia->id],
            ['name' => 'Millicent', 'country_id' => $australia->id],
            ['name' => 'Churchill', 'country_id' => $australia->id],
            ['name' => 'Renmark', 'country_id' => $australia->id],
            ['name' => 'Wingham', 'country_id' => $australia->id],
            ['name' => 'Maffra', 'country_id' => $australia->id],
            ['name' => 'Glenella', 'country_id' => $australia->id],
            ['name' => 'Rasmussen', 'country_id' => $australia->id],
            ['name' => 'Tanunda', 'country_id' => $australia->id],
            ['name' => 'Old Bar', 'country_id' => $australia->id],
            ['name' => 'George Town', 'country_id' => $australia->id],
            ['name' => 'Wyong', 'country_id' => $australia->id],
            ['name' => 'Broadford', 'country_id' => $australia->id],
            ['name' => 'Drysdale', 'country_id' => $australia->id],
            ['name' => 'Tatura', 'country_id' => $australia->id],
            ['name' => 'Cockatoo', 'country_id' => $australia->id],
            ['name' => 'Deeragun', 'country_id' => $australia->id],
            ['name' => 'Victor Harbor', 'country_id' => $australia->id],
            ['name' => 'Latrobe', 'country_id' => $australia->id],
            ['name' => 'Berri', 'country_id' => $australia->id],
            ['name' => 'Wellington', 'country_id' => $australia->id],
            ['name' => 'Thirlmere', 'country_id' => $australia->id],
            ['name' => 'Legana', 'country_id' => $australia->id],
            ['name' => 'Temora', 'country_id' => $australia->id],
            ['name' => 'The Entrance', 'country_id' => $australia->id],
            ['name' => 'Mansfield', 'country_id' => $australia->id],
            ['name' => 'Gerringong', 'country_id' => $australia->id],
            ['name' => 'Loxton', 'country_id' => $australia->id],
            ['name' => 'Somerset', 'country_id' => $australia->id],
            ['name' => 'Korumburra', 'country_id' => $australia->id],
            ['name' => 'Picton', 'country_id' => $australia->id],
            ['name' => 'Trafalgar', 'country_id' => $australia->id],
            ['name' => 'Pearcedale', 'country_id' => $australia->id],
            ['name' => 'Numurkah', 'country_id' => $australia->id],
            ['name' => 'Peregian Beach', 'country_id' => $australia->id],
            ['name' => 'Narrandera', 'country_id' => $australia->id],
            ['name' => 'Suffolk Park', 'country_id' => $australia->id],
            ['name' => 'Buninyong', 'country_id' => $australia->id],
            ['name' => 'Longford', 'country_id' => $australia->id],
            ['name' => 'Kerang', 'country_id' => $australia->id],
            ['name' => 'Weston', 'country_id' => $australia->id],
            ['name' => 'Sawtell', 'country_id' => $australia->id],
            ['name' => 'Silverdale', 'country_id' => $australia->id],
            ['name' => 'Roxby Downs', 'country_id' => $australia->id],
            ['name' => 'Bay View', 'country_id' => $australia->id],
            ['name' => 'Lismore', 'country_id' => $australia->id],
            ['name' => 'Merimbula', 'country_id' => $australia->id],
            ['name' => 'Scarness', 'country_id' => $australia->id],
            ['name' => 'Lake Cathie', 'country_id' => $australia->id],
            ['name' => 'Paynesville', 'country_id' => $australia->id],
            ['name' => 'Perth', 'country_id' => $australia->id],
            ['name' => 'Maddingley', 'country_id' => $australia->id],
            ['name' => 'Proserpine', 'country_id' => $australia->id],
            ['name' => 'Cobar', 'country_id' => $australia->id],
            ['name' => 'Aldgate', 'country_id' => $australia->id],
            ['name' => 'Port Fairy', 'country_id' => $australia->id],
            ['name' => 'Koo-Wee-Rup', 'country_id' => $australia->id],
            ['name' => 'Penguin', 'country_id' => $australia->id],
            ['name' => 'Beachmere', 'country_id' => $australia->id],
            ['name' => 'Smithton', 'country_id' => $australia->id],
            ['name' => 'McLaren Vale', 'country_id' => $australia->id],
            ['name' => 'Euroa', 'country_id' => $australia->id],
            ['name' => 'Bellingen', 'country_id' => $australia->id],
            ['name' => 'Mullumbimby', 'country_id' => $australia->id],
            ['name' => 'Tura Beach', 'country_id' => $australia->id],
            ['name' => 'Eden', 'country_id' => $australia->id],
            ['name' => 'Red Cliffs', 'country_id' => $australia->id],
            ['name' => 'Bogangar', 'country_id' => $australia->id],
            ['name' => 'Shoalhaven Heads', 'country_id' => $australia->id],
            ['name' => 'Blayney', 'country_id' => $australia->id],
            ['name' => 'Stirling', 'country_id' => $australia->id],
            ['name' => 'Wilton', 'country_id' => $australia->id],
            ['name' => 'Kapunda', 'country_id' => $australia->id],
            ['name' => 'Terranora', 'country_id' => $australia->id],
            ['name' => 'Woori Yallock', 'country_id' => $australia->id],
            ['name' => 'Saint Georges Basin', 'country_id' => $australia->id],
            ['name' => 'Camperdown', 'country_id' => $australia->id],
            ['name' => 'Culburra', 'country_id' => $australia->id],
            ['name' => 'Deloraine', 'country_id' => $australia->id],
            ['name' => 'Tea Gardens', 'country_id' => $australia->id],
            ['name' => 'Bonny Hills', 'country_id' => $australia->id],
            ['name' => 'McCrae', 'country_id' => $australia->id],
            ['name' => 'North Wonthaggi', 'country_id' => $australia->id],
            ['name' => 'Thursday Island', 'country_id' => $australia->id],
            ['name' => 'Urunga', 'country_id' => $australia->id],
            ['name' => 'Vincentia', 'country_id' => $australia->id],
            ['name' => 'West Wyalong', 'country_id' => $australia->id],
            ['name' => 'Howlong', 'country_id' => $australia->id],
            ['name' => 'Lawson', 'country_id' => $australia->id],
            ['name' => 'Narooma', 'country_id' => $australia->id],
            ['name' => 'Quirindi', 'country_id' => $australia->id],
            ['name' => 'Condobolin', 'country_id' => $australia->id],
            ['name' => 'Margate', 'country_id' => $australia->id],
            ['name' => 'Aberdare', 'country_id' => $australia->id],
            ['name' => 'Dodges Ferry', 'country_id' => $australia->id],
            ['name' => 'Gilgandra', 'country_id' => $australia->id],
            ['name' => 'Launching Place', 'country_id' => $australia->id],
            ['name' => 'Goolwa', 'country_id' => $australia->id],
            ['name' => 'Rutherglen', 'country_id' => $australia->id],
            ['name' => 'Hahndorf', 'country_id' => $australia->id],
            ['name' => 'Willunga', 'country_id' => $australia->id],
            ['name' => 'Sandy Beach', 'country_id' => $australia->id],
            ['name' => 'Hadspen', 'country_id' => $australia->id],
            ['name' => 'Beaconsfield Upper', 'country_id' => $australia->id],
            ['name' => 'Hill Top', 'country_id' => $australia->id],
            ['name' => 'Williamstown', 'country_id' => $australia->id],
            ['name' => 'Jindabyne', 'country_id' => $australia->id],
            ['name' => 'Freeling', 'country_id' => $australia->id],
            ['name' => 'Lobethal', 'country_id' => $australia->id],
            ['name' => 'The Oaks', 'country_id' => $australia->id],
            ['name' => 'Baxter', 'country_id' => $australia->id],
            ['name' => 'Saint Arnaud', 'country_id' => $australia->id],
            ['name' => 'Esperance', 'country_id' => $australia->id],
            ['name' => 'Heddon Greta', 'country_id' => $australia->id],
            ['name' => 'Freshwater', 'country_id' => $australia->id],
            ['name' => 'Grenfell', 'country_id' => $australia->id],
            ['name' => 'Bangalow', 'country_id' => $australia->id],
            ['name' => 'Kawana Waters', 'country_id' => $australia->id],
            ['name' => 'Orbost', 'country_id' => $australia->id],
            ['name' => 'Manilla', 'country_id' => $australia->id],
            ['name' => 'Camden Haven', 'country_id' => $australia->id],
            ['name' => 'Wallerawang', 'country_id' => $australia->id],
            ['name' => 'Wattleglen', 'country_id' => $australia->id],
            ['name' => 'Mulwala', 'country_id' => $australia->id],
            ['name' => 'Barmera', 'country_id' => $australia->id],
            ['name' => 'Windsor', 'country_id' => $australia->id],
            ['name' => 'Woodside', 'country_id' => $australia->id],
            ['name' => 'Lyndoch', 'country_id' => $australia->id],
            ['name' => 'Batehaven', 'country_id' => $australia->id],
            ['name' => 'Queenstown', 'country_id' => $australia->id],
            ['name' => 'Yarram', 'country_id' => $australia->id],
            ['name' => 'Brunswick Heads', 'country_id' => $australia->id],
            ['name' => 'Waikerie', 'country_id' => $australia->id],
            ['name' => 'Westbury', 'country_id' => $australia->id],
            ['name' => 'Yaroomba', 'country_id' => $australia->id],
            ['name' => 'Curlewis', 'country_id' => $australia->id],
            ['name' => 'Denman', 'country_id' => $australia->id],
            ['name' => 'Bourke', 'country_id' => $australia->id],
            ['name' => 'Nathalia', 'country_id' => $australia->id],
            ['name' => 'Tathra', 'country_id' => $australia->id],
            ['name' => 'Cobden', 'country_id' => $australia->id],
            ['name' => 'Drummond Cove', 'country_id' => $australia->id],
            ['name' => 'Canowindra', 'country_id' => $australia->id],
            ['name' => 'Yarragon', 'country_id' => $australia->id],
            ['name' => 'Walgett', 'country_id' => $australia->id],
            ['name' => 'Surfside', 'country_id' => $australia->id],
            ['name' => 'Seven Mile Beach', 'country_id' => $australia->id],
            ['name' => 'San Remo', 'country_id' => $australia->id],
            ['name' => 'Greenwell Point', 'country_id' => $australia->id],
            ['name' => 'Valley Heights', 'country_id' => $australia->id],
            ['name' => 'Oakdale', 'country_id' => $australia->id],
            ['name' => 'Yallourn North', 'country_id' => $australia->id],
            ['name' => 'Innisfail', 'country_id' => $australia->id],
            ['name' => 'Mollymook', 'country_id' => $australia->id],
            ['name' => 'Evandale', 'country_id' => $australia->id],
            ['name' => 'Wahgunyah', 'country_id' => $australia->id]
        ]);
    }
}
