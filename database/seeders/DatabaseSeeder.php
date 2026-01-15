<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Car;
use App\Models\CarImage;
use App\Models\CarType;
use App\Models\FuelType;
use App\Models\Gearbox;
use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use App\Models\Voivodeship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {   

        CarType::factory()
            ->sequence(

                ['name' =>'Sedan'],
                ['name' =>'Hatchback'],
                ['name' =>'SUV'],
                ['name' =>'Pickup Truck'],
                ['name' =>'Minivan'],
                ['name' =>'Jeep'],
                ['name' =>'Coupe'],
                ['name' =>'Crossover'],
                ['name' =>'Sports Car'],

            )
            ->count(9)
            ->create();

        FuelType::factory()
            ->sequence(

                ['name' => 'Gasoline'],
                ['name' => 'Diesel'],
                ['name' => 'LPG'],
                ['name' => 'Electric'],
                ['name' => 'Hybrid'],

            )
            ->count(5)
            ->create();

        Gearbox::factory()
            ->sequence(

                ['name' => 'automatic'],
                ['name' => 'manual']

            )
            ->count(2)
            ->create();


        $voivodeships = [
            'dolnośląskie' => ['Wrocław', 'Legnica', 'Wałbrzych'],
            'kujawsko-pomorskie' => ['Bydgoszcz', 'Toruń', 'Włocławek'],
            'lubelskie' => ['Lublin', 'Chełm', 'Zamość'],
            'lubuskie' => ['Gorzów Wielkopolski', 'Zielona Góra', 'Nowa Sól'],
            'łódzkie' => ['Łódź', 'Piotrków Trybunalski', 'Pabianice'],
            'małopolskie' => ['Kraków', 'Tarnów', 'Nowy Sącz'],
            'mazowieckie' => ['Warszawa', 'Radom', 'Płock'],
            'opolskie' => ['Opole', 'Kędzierzyn-Koźle', 'Nysa'],
            'podkarpackie' => ['Rzeszów', 'Przemyśl', 'Stalowa Wola'],
            'podlaskie' => ['Białystok', 'Suwałki', 'Łomża'],
            'pomorskie' => ['Gdańsk', 'Gdynia', 'Słupsk'],
            'śląskie' => ['Katowice', 'Gliwice', 'Częstochowa'],
            'świętokrzyskie' => ['Kielce', 'Ostrowiec Świętokrzyski', 'Starachowice'],
            'warmińsko-mazurskie' => ['Olsztyn', 'Elbląg', 'Ełk'],
            'wielkopolskie' => ['Poznań', 'Kalisz', 'Konin'],
            'zachodniopomorskie' => ['Szczecin', 'Koszalin', 'Świnoujście'],
        ];


        foreach($voivodeships as $voivodeship => $cities){

            Voivodeship::factory()
                ->state(['name' => $voivodeship])
                ->has(
                    City::factory()
                    ->count(count($cities))
                    ->sequence(

                        ...array_map(fn($city) =>['name' => $city], $cities))

                    )
                    ->create();
                


        }
        
        $makers = [

            'Audi' => ['A3', 'A4', 'A6', 'Q5', 'Q7'],
            'BMW' => ['Seria 1', 'Seria 3', 'Seria 5', 'X3', 'X5'],
            'Mercedes-Benz' => ['A-Class', 'C-Class', 'E-Class', 'GLC', 'GLE'],
            'Toyota' => ['Corolla', 'Camry', 'Yaris', 'RAV4', 'Land Cruiser'],
            'Volkswagen' => ['Golf', 'Passat', 'Polo', 'Tiguan', 'Touareg'],
            'Ford' => ['Focus', 'Fiesta', 'Mondeo', 'Kuga', 'Mustang'],
            'Honda' => ['Civic', 'Accord', 'CR-V', 'HR-V'],
            'Hyundai' => ['i30', 'i20', 'Tucson', 'Santa Fe'],
            'Kia' => ['Ceed', 'Sportage', 'Sorento', 'Picanto'],
            'Skoda' => ['Octavia', 'Superb', 'Fabia', 'Kodiaq'],

        ];

        foreach($makers as $maker => $models){

            Maker::factory()
                ->state(['name' => $maker])
                ->has(

                    Model::factory()
                        ->count(count($models))
                        ->sequence(

                            ...array_map(fn($model) =>['name' => $model],$models )
                            
                        )
                                    
                )
                ->create();

        }
    
        
        User::factory()
        ->count(3)
        ->create();

        User::factory()
        ->count(2)
        ->has(

            Car::factory()
                ->count(50)
                ->has(
                    
                    CarImage::factory()
                        ->count(5)
                        ->sequence(fn (Sequence $sequence) => 
                        ['position' => $sequence->index + 1]),
                        'images'
    
                )
                ->hasFeatures(),
                'favouriteCars'

        )
        ->create();
        
    }

}